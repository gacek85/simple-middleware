<?php
namespace Gacek85\Middleware\Test;

use Gacek85\Middleware\Context;
use Gacek85\Middleware\ContextInterface;
use Gacek85\Middleware\Registry;

/**
 *  Registry test case
 *
 *  @author Maciej Garycki <maciekgarycki@gmail.com>
 *  @copyrights Maciej Garycki 2016
 */
class RegistryTest extends AbstractMiddlewareAwareTest 
{
    /**
     *
     * @var Registry
     */
    protected $registry = null;
    
    
    protected function setUp()
    {
        $this->registry = new Registry();
    }
    
    
    public function testRegistry()
    {
        $this->addMiddlewares();        
        $this->resetCounter();
        $value = $this->registry->execute(new Context());
        $this->assertEquals(2, $this->counter);
        $this->assertEquals('some value 2', $value);
    }
    
    
    protected function addMiddlewares()
    {
        array_map(function(callable $middleware){
            $instance = $this->registry->add($middleware);
            $this->assertInstanceOf(Registry::class, $instance);
            $this->assertSame($this->registry, $instance);
        }, $this->getMiddlewares());
    }
    
    
    public function testInsert()
    {
        $this->addMiddlewares();
        $this->registry->insert(1, function(ContextInterface $context, callable $next){
            $this->counter++;
            $this->assertTrue(is_callable($next));
            $this->assertTrue($context->has('s1'));
            $this->assertEquals('v1', $context->get('s1'));
            $context->set('s3', 'v3');
            
            return call_user_func($next, $context);
        });
        
        $this->registry->remove(2);
//        $this->registry->insert(2, function(ContextInterface $context, callable $next){
//            $this->counter++;
//            $this->assertTrue(is_callable($next));
//            $this->assertTrue($context->has('s3'));
//            $this->assertEquals('v3', $context->get('s3'));
//            
//            return 'final value';
//        });
        
        $this->assertEquals(2, $this->registry->count());
        
        
        $this->resetCounter();
        $value = $this->registry->execute(new Context());
        $this->assertEquals(2, $this->counter);
        $this->assertEquals('final value', $value);
    }
}