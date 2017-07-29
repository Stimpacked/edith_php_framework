<?php
/**
 * Session handler
 *
 * @Author: Stefan Sjönnebring
 * 
 */
class Session
{

	public static function init()
	{
		if(session_status() == PHP_SESSION_NONE)
		{
			session_start();
		}
	}

	/**
     * Set $_SESSION key value
     *
     * @param $key, $value.
     */
	public static function set($key, $value)
	{
		$_SESSION[$key] = $value;
	}

	/**
     * Get specific $_SESSION value
     *
     * @param $key
     * @return $_SESSION value
     */
	public static function get($key)
	{
		if(isset($_SESSION[$key])) 
		{
			return $_SESSION[$key];
		}
		
	}

	/**
     * Destroy a session
     *
     */
	public static function destroy()
	{
		//unset($_SESSION);
		session_destroy();
	}
	
}
