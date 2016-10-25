<?php
namespace Gacek85\Middleware;

use ArrayAccess;
use Gacek85\Middleware\ContextInterface;
use InvalidArgumentException;

/**
 *  Default implementation of \Gacek85\Middleware\ContextInterface. Provides
 *  array access to stored values.
 *
 *  @author Maciej Garycki <maciekgarycki@gmail.com>
 *  @copyrights Maciej Garycki 2016
 */
class Context implements ContextInterface, ArrayAccess
{
    protected $values = [];
    
    /**
     * Gets content stored under given key
     * 
     * @param       string      $key            The key under which value is stored
     * 
     * @throws      InvalidArgumentException    If the key does not exist
     */
    public function get(string $key)
    {
        if (!$this->has($key)) {
            throw new InvalidArgumentException(sprintf(
                'Value for key `%s` does not exist!',
                $key
            ));
        }
        
        return $this->values[$key];
    }
    
    
    /**
     * Returns true if context has given key. False otherwise.
     * 
     * @param       string      $key
     * 
     * @return      bool 
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->values);
    }
    
    
    /**
     * Stores value for given key
     * 
     * @param       string      $key            The key under which value will be stored
     * 
     * @param       mixed       $value          The value to store
     * 
     * @return      ContextInterface            Current implementation of this interface
     */
    public function set(string $key, $value): ContextInterface
    {
        $this->values[$key] = $value;
        return $this;
    }

    
    /**
     * \ArrayAccess method: Returns true if offset exist
     * 
     * @param       string      $offset
     * 
     * @return      bool
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    
    /**
     * \ArrayAccess method: Returns stored value
     * 
     * @param       string      $offset
     * 
     * @return      mixed       
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }
    

    /**
     * \ArrayAccess method: Sets the value for given offset
     * 
     * @param       string      $offset
     * 
     * @return      mixed       
     */
    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }
    

    /**
     * \ArrayAccess method: Unsets the value for given offset
     * 
     * @param       string      $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->values[$offset]);
    }

}