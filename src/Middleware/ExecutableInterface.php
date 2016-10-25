<?php
namespace Gacek85\Middleware;

/**
 *  Defines executable (against ContextInterface) behavior
 *
 *  @author Maciej Garycki <maciekgarycki@gmail.com>
 *  @copyrights Maciej Garycki 2016
 */
interface ExecutableInterface 
{
    /**
     * Executes the logic against given context
     * 
     * @param       ContextInterface        $context
     * @return      mixed
     */
    public function execute(ContextInterface $context);
}