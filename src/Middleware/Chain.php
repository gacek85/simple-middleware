<?php
namespace Gacek85\Middleware;

use Gacek85\Middleware\ExecutableInterface;
use SplStack;

/**
 *  Chain of the middlewares
 *
 *  @author Maciej Garycki <maciekgarycki@gmail.com>
 *  @copyrights Maciej Garycki 2016
 */
class Chain extends SplStack implements ExecutableInterface
{   
    
    /**
     * Constructs the executable chain of middlewares
     * 
     * @param       array       $middlewares
     */
    public function __construct(array $middlewares)
    {
        $this->doConstruct(array_reverse($middlewares));
    }
    
    
    protected function doConstruct(array $middlewares)
    {
        $this[] = $this->getTerminator();

        array_map(function (callable $callable) {
            $next = $this->top();
            $this[] = function (ContextInterface $context) use ($callable, $next) {
                return call_user_func($callable, $context, $next);
            };
        }, $middlewares);
    }
    
    protected function getTerminator(): callable 
    {
        return function (ContextInterface $context){};
    }
    
    
    /**
     * Executes the registered middlewares and returns the output of 
     * chain execution
     * 
     * @param       ContextInterface            $context
     * @return      mixed
     */
    public function execute(ContextInterface $context)
    {
        return call_user_func($this->top(), $context);
    }
}