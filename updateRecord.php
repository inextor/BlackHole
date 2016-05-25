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
	$record			=  new record();

	if( empty( $_POST['id'] ) )
		throw new ValidationException('Keyword can\'t be empty');

	$record->id			= $_POST['id'];
	$record->data 		= $_POST['data'];

	if( !$record->updateDb() )
		throw new SystemException('Fails to save');

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
