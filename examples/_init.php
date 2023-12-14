<?php
// load the class autoloader. If you're using Composer, you don't need to use this autoloader
require '../src/autoload.php';

// the bearer token has a life time of 24 hours so we delete it if it's too old to get a new one
if ( is_file('./examples_token.txt') && (filemtime('./examples_token.txt') < time()-86000) )
	{
	unlink('./examples_token.txt');
	}

// load the token if we have it, if not, we use an empty string to signify we don't have one
$token = is_file('./examples_token.txt') ? file_get_contents('./examples_token.txt') : '';

// create a test instance (username clienttest)
$fan = Fancourier\Fancourier::testInstance($token);
// to create a normal instance use this:
// $fan = new Fancourier\Fancourier($clientId, $username, $password, $token);

// if you don't cache the token (not recommended), you don't need to call the getToken() function as it's called automatically when needed
if ($token == '')
	{
	$token = $fan->getToken(true);	// force refresh of token (if the param is not set or false, it will just return the existing token or empty string)
	if ($token)
		{
		// save the token
		file_put_contents('./examples_token.txt', $token);
		}
	else
		{
		// error when getting token, show error
		echo $fan->getTokenMessage();
		exit;
		}
	}

// you can get the token at any time using
// $fan->getToken();
