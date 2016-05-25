<?php

/**
 * addLog.php:
 * @param keyword, message.
 * @return response object.
 */

include_once( __DIR__.'/api.php' );
include_once( __DIR__.'/tables.php');

use \akou\ApiResponse;
use \akou\DBTable;
use \akou\Utils;
use \akou\LoggableException;
use \akou\SystemException;
use \akou\ValidationException;

$apiResponse	= new ApiResponse();

try
{
	if( empty( $_POST['keyword'] ) )
		throw new ValidationException('The parameter "keyword" cant be empty');

	$sqlIds = 'SELECT id
		FROM record
		WHERE keyword ="'.DBTable::$connection->real_escape_string( $_POST['keyword'] ).'"';

	$resIds = DBTable::$connection->query( $sqlIds );

	if( !$resIds )
		throw new SystemException('Fail to retrieve ids '. $sqlIds );

	$ids = array();

	while( $row = $resIds->fetch_object() )
	{
		$ids	[] = $row->id;
	}

	$apiResponse->setData( $ids );
	$apiResponse->setResult(1);
	$apiResponse->output();
}
catch(\Exception $e)
{
	$apiResponse->setError( $e );
	$apiResponse->output();
}

$apiResponse->setMsg('An error occurred please try again later');
$apiResponse->output();
