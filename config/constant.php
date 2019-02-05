<?php

define('THEME_NAME','theme-green');

if ($_SERVER['HTTP_HOST'] == "localhost" || preg_match("/^192\.168\.0.\d+$/",$_SERVER['HTTP_HOST'])) 
{
    define('DB_NAME','hpapple_2019');
	define('DB_HOST','localhost');
	define('DB_USERNAME','root');
	define('DB_PASSWORD','');

	if ($_SERVER['HTTP_HOST'] == "localhost")
	{
		define('BASE_FOLDER','http://localhost/applepanel');
	}
	else
	{
		define('BASE_FOLDER','applepanel');
	}
}
else
{
    define('DB_NAME','hpapple_2019');
	define('DB_HOST','localhost');
	define('DB_USERNAME','root');
	define('DB_PASSWORD','');

	define('BASE_FOLDER','https://thefarmercompany.com/applepanel');
}


?>