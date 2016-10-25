<?php
namespace Gacek85\Middleware\Test;

use Gacek85\Middleware\Context;
use PHPUnit_Framework_TestCase;

/**
 *  Context test case
 *
 *  @author Maciej Garycki <maciekgarycki@gmail.com>
 *  @copyrights Maciej Garycki 2016
 */
class ContextTest extends PHPUnit_Framework_TestCase
{
    /**
     *
     * @var Context
     */
    protected $context = null;
    
    
    
    protected function setUp()
    {
        $this->context = new Context();
    }
    
    
    /**
     * @expectedException           \InvalidArgumentException
     * @expectedExceptionMessage    Value for key `non_existing_value` does not exist!
     */
    public function testGetException()
    {
        $this->context->get('non_existing_value');
    }
    
    public function testHas()
    {
        $this->assertEquals(false, $this->context->has('non_existing_value'));
    }
    
    
    public function testSet()
    {
        $instance = $this->context->set('some', 'value');
        $this->assertInstanceOf(Context::class, $instance);
        $this->assertSame($this->context, $instance);
        $this->assertEquals('value', $instance->get('some'));
        $this->assertEquals('value', $instance['some']);
        $instance['some2'] = 'another value';
        $this->assertEquals('another value', $instance->get('some2'));
        $this->assertEquals('another value', $instance['some2']);
        $this->assertTrue(isset($instance['some2']));
        $this->assertTrue($instance->has('some2'));
        unset($instance['some2']);
        $this->assertFalse(isset($instance['some2']));
        $this->assertFalse($instance->has('some2'));
    }
    
}