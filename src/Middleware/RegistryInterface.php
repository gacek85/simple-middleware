<?php
namespace Gacek85\Middleware;

/**
 *  RegistryInterface 
 *
 *  @author Maciej Garycki <maciekgarycki@gmail.com>
 *  @copyrights Maciej Garycki 2016
 */
interface RegistryInterface extends ExecutableInterface
{
    /**
     * Adds middleware to the end of the chain
     * 
     * @param       callable            $middleware
     * 
     * @return      RegistryInterface   This interface implementation
     */
    public function add(callable $middleware): RegistryInterface;
    
    
    /**
     * Inserts middleware at given position
     * 
     * @param       int                 $position
     * 
     * @param       callable            $middleware
     * 
     * @return      RegistryInterface   This interface implementation
     */
    public function insert(int $position, callable $middleware): RegistryInterface;
    
    
    /**
     * Removes middleware on given position
     * 
     * @param       int         $position
     * 
     * @return      RegistryInterface   This interface implementation
     */
    public function remove(int $position): RegistryInterface;
    
    
    /**
     * Returns number of registered middlewares
     * 
     * @return      int
     */
    public function count(): int;
}