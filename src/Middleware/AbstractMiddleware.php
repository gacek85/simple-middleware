<?php
namespace Gacek85\Middleware;

/**
 *  Abstraction for Middleware
 *
 *  @author Maciej Garycki <maciekgarycki@gmail.com>
 *  @copyrights Maciej Garycki 2016
 */
abstract class AbstractMiddleware 
{
    /**
     * Executes the call. Implementation of callable.
     * 
     * @param       ContextInterface        $context
     * @param       callable                $next
     * @return      mixed
     */
    public function __invoke(ContextInterface $context, callable $next)
    {
        return $this->execute($context, $next);
    }


    /**
     * Executes middleware against context and next middleware item
     * 
     * @param       ContextInterface        $context
     * @return      mixed
     */
    abstract protected function execute(ContextInterface $context, callable $next);
}