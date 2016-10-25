<?php
namespace Gacek85\Middleware;

use Gacek85\Middleware\RegistryInterface;
use Gacek85\Middleware\Chain;
use Gacek85\Middleware\AbstractMiddleware;

/**
 *  Registers the middlewares and executes them.
 *  Default implementation of RegistryInterface
 *
 *  @author Maciej Garycki <maciekgarycki@gmail.com>
 *  @copyrights Maciej Garycki 2016
 */
class Registry implements RegistryInterface
{
    /**
     *
     * @var AbstractMiddleware[];
     */
    protected $chain = [];
    
    /**
     * Adds middleware to the end of the chain
     * 
     * @param       callable            $middleware
     * @return      Registry            This instance
     */
    public function add(callable $middleware): RegistryInterface
    {
        $this->chain[] = $middleware;
        return $this;
    }
    
    
    /**
     * Inserts middleware at given position
     * 
     * @param       int                 $offset       Indexed from 0
     * 
     * @param       callable            $middleware
     * 
     * @return      Registry            This instance
     */
    public function insert(int $offset, callable $middleware): RegistryInterface
    {
        array_splice($this->chain, $offset, 0, [$middleware]);
        return $this;
    }
    
    
    /**
     * Removes middleware on given position
     * 
     * @param       int         $offset
     * 
     * @return      RegistryInterface   This interface implementation
     */
    public function remove(int $offset): RegistryInterface
    {
        array_splice($this->chain, $offset, 1);
        return $this;
    }
    
    
    /**
     * Returns number of registered middlewares
     * 
     * @return      int
     */
    public function count(): int
    {
        return count($this->chain);
    }
    
    
    /**
     * Runs the middleware chain against given context
     * 
     * @param       Context             $context
     * @return      mixed               
     */
    public function execute(ContextInterface $context)
    {
        return (new Chain($this->chain))->execute($context);
    }
}