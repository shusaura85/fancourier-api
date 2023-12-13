<?php

function fancourier_autoload_class($class_name)
	{
	$class_name = ltrim($class_name, '\\');
	$file_name  = '';
	$file_name .= str_replace("\\", "/", $class_name . ".php");
	
	if (is_file(__DIR__.DIRECTORY_SEPARATOR.$file_name) )
		{
		require __DIR__.DIRECTORY_SEPARATOR.$file_name;
		}
	}

spl_autoload_register(__NAMESPACE__ .'\fancourier_autoload_class');
