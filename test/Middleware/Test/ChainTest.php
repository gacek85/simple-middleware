<?php
namespace Gacek85\Middleware\Test;

use Gacek85\Middleware\Chain;
use Gacek85\Middleware\Context;

/**
 *  Chain test case
 *
 *  @author Maciej Garycki <maciekgarycki@gmail.com>
 *  @copyrights Maciej Garycki 2016
 */
class ChainTest extends AbstractMiddlewareAwareTest 
{
    
    public function testConstruct()
    {
        $this->resetCounter();
        $chain = new Chain($this->getMiddlewares());
        $value = $chain->execute(new Context());
        $this->assertEquals(2, $this->counter);
        $this->assertEquals('some value 2', $value);
    }
}