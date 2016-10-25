<?php
namespace Gacek85\Middleware;

use InvalidArgumentException;

/**
 *  ContextInterface defines context methods
 *
 *  @author Maciej Garycki <maciekgarycki@gmail.com>
 *  @copyrights Maciej Garycki 2016
 */
interface ContextInterface 
{
    /**
     * Gets content stored under given key
     * 
     * @param       string      $key            The key under which value is stored
     * 
     * @throws      InvalidArgumentException    If the key does not exist
     */
    public function get(string $key);
    
    
    /**
     * Returns true if context has given key. False otherwise.
     * 
     * @param       string      $key
     * 
     * @return      bool 
     */
    public function has(string $key): bool;
    
    
    /**
     * Stores value for given key
     * 
     * @param       string      $key            The key under which value will be stored
     * 
     * @param       mixed       $value          The value to store
     * 
     * @return      ContextInterface            Current implementation of this interface
     */
    public function set(string $key, $value): ContextInterface;
}