<?php
	namespace Novus\App;
	
	abstract class Autoloader {

		public static function register() {
			spl_autoload_register(array(__CLASS__, 'autoload'));
		}

		public static function autoload($class) {

			$class = str_replace('Novus', 'src', $class);
			$parts = preg_split('#\\\#', $class);
			$className = array_pop($parts);
			$path = implode(DS, $parts);			
			$file = $className.'.php';

			$filepath = $GLOBALS['root_dir'].DS.$path.DS.$file;
			if(file_exists($filepath)){
				require $filepath;
			}
			// require '..'.$GLOBALS['root_dir'].'/src/Controller/HomeController.php';
		}
	}
