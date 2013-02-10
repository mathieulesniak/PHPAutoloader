PHPAutoloader
========

Simple PHP Autoloader
----------------------------------------

**PHPAutoloader** is a simple autoloader class, with support of directory mapping.

**PHPAutoloader** is heavily based on [Laurent Goussard](https://github.com/mathieulesniak/eSKUeL/blob/master/libs/init.inc.php)'s script.

Installation
----------------------------------------

* Simply download the lastest PHPAutoloader package ([zip](http://github.com/mathieulesniak/PHPAutoloader/zipball/master) or [tarball](http://github.com/mathieulesniak/PHPAutoloader/tarball/master)) and put autoloader.php somewhere accessible in your application (ie in /libs/ directory)
* Define your directory mapping
* Instanciate
* And voilà !


How to use
----------------------------------------

PHPAutoloader support directory mapping for your applications. For example, you can split your objects into separate directories as "controller", "models" and "views".
All you need to to is define your mapping in an associative array, using objects type as key, and directory name as value : 

	$autoloaderMap = array(
		'controller' => 'controllersDirectory',
		'view'	=> 'viewsDir',
		'model' => 'modelsDir',
		'default' => 'libsDir'
		);
	$baseDir = $_SERVER['DOCUMENT_ROOT'];
	AutoLoader::register($baseDir,	$autoloaderMap);

You can define a "default" directory where all non matched object will be located.

PHPLoader use camelCase naming convention to get object type, ie myClassModel will be matched as a "model", myObjectView as a "view", etc.

Dependencies
----------------------------------------
* [PHP 5.2+](http://www.php.net)

License
----------------------------------------
[GNU General Public License](http://opensource.org/licenses/gpl-3.0.html)

Author
----------------------------------------
Mathieu LESNIAK ([mathieu@lesniak.fr](mailto:mathieu@lesniak.fr))