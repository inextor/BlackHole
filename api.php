<?php

include_once( __DIR__.'/akou/src/LoggableException.php' );
include_once( __DIR__.'/akou/src/Utils.php' );
include_once( __DIR__.'/akou/src/DBTable.php' );
include_once( __DIR__.'/akou/src/ApiResponse.php' );

use \akou\ApiResponse;
use \akou\DBTable;
use \akou\Utils;
use \akou\LoggableException;
use \akou\SystemException;
use \akou\ValidationException;

date_default_timezone_set('UTC');

Utils::$DEBUG 				= true;
Utils::$LOG_CLASS			= 'log';
Utils::$LOG_CLASS_KEY_ATTR	= 'keyword';
Utils::$LOG_CLASS_DATA_ATTR	= 'data';

API::connect();

class API
{
	const DEFAULT_EMAIL					= '';
	const LIVE_DOMAIN_PROTOCOL			= 'http://';
	const LIVE_DOMAIN					= '';
	const DEBUG							= FALSE;

	public static $GENERIC_MESSAGE_ERROR	= 'Please verify details and try again later';

	public static function connect()
	{
		if( Utils::isDebugEnviroment() )
		{
			$__user	 	= 'test';
			$__password	= 'test';
			$__db		= 'test';
			$__host	 	= 'localhost';
			$__port	 	= '3306';
		}
		else
		{
			$__user	 	= 'test';
			$__password	= 'test';
			$__db		= 'test';
			$__host	 	= 'localhost';
			$__port	 	= '3306';
		}

		$mysqli = new mysqli($__host, $__user, $__password, $__db );


		if( $mysqli->connect_errno )
		{
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			exit();
		}

		$mysqli->query("SET NAMES 'utf8'");
		$mysqli->set_charset('utf8');

		DBTable::$connection				= $mysqli;
	}
}
