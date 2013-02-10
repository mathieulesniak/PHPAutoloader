<?php
class AutoLoader
{
	static private $dirMap = array();
	static private $root;

	static public function autoload($class)
	{
		$convertedClassName = preg_replace('|([a-z])([A-Z])|', '$1_$2', $class);
		$splitted 			= explode('_', $convertedClassName);
		$classType 			= strtolower(array_pop($splitted));
		$dir 				= '';
		
		if ( isset(self::$dirMap[$classType]) )
		{
			$dir = self::$dirMap[$classType];
			$filename = self::$root . '/' . $dir . '/' . str_replace(ucFirst($classType), '', $class) . '.php';
		}
		else if ( isset(self::$dirMap['default']) )
		{
			$dir = self::$dirMap['default'];
			$filename = self::$root . '/' . $dir . '/' . $class . '.php';
		}
		
		if ( $dir != '' )
		{	
			if ( is_file($filename) )
			{
				include $filename;
			}
			else
			{
				throw new AutoLoaderException("Object '$class' not found", 2);
			}
			
		}
		else
		{
			throw new AutoLoaderException("Unknown object type / No directory found", 1);
		}
	}

	static public function loadClass($class)
	{
		if ( !class_exists($class, false) && !interface_exists($class, false) )
		{
			self::autoload($class);
			if ( !class_exists($class, false) && !interface_exists($class, false) )
			{
				throw new AutoLoaderException("File loaded, but '$class' does not exist");
			}
		}
	}

	static public function register($root, $dirMap) 
	{
		self::$dirMap 	= $dirMap;
		self::$root 	= $root;
		
		ini_set('unserialize_callback_func', 'spl_autoload_call');
		spl_autoload_register(array(__CLASS__, 'loadClass'));
	}

	static public function unRegister() 
	{
		spl_autoload_unregister(array(__CLASS__, 'loadClass'));
	}
}

class AutoloaderException extends Exception {}
?>