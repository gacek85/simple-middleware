<?php
namespace Gacek85\Middleware\Test;

use Gacek85\Middleware\ContextInterface;
use PHPUnit_Framework_TestCase;

/**
 *  Abstraction aware about callable middlewares
 *
 *  @author Maciej Garycki <maciekgarycki@gmail.com>
 *  @copyrights Maciej Garycki 2016
 */
abstract class AbstractMiddlewareAwareTest extends PHPUnit_Framework_TestCase 
{
    protected $counter = 0;
    
    protected function resetCounter(): AbstractMiddlewareAwareTest 
    {
        $this->counter = 0;
        return $this;
    }
    
    protected function getMiddlewares(): array
    {
        return [
            function (ContextInterface $context, callable $next){
                $this->counter++;
                $this->assertTrue(is_callable($next));
                $context->set('s1', 'v1');
                
                return call_user_func($next, $context);
            },
            function (ContextInterface $context, callable $next){
                $this->counter++;
                $this->assertTrue($context->has('s1'));
                $this->assertEquals('v1', $context->get('s1'));
                
                return 'some value 2';
            }
        ];
    }
}