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
	if( empty( $_REQUEST['id'] ) )
		throw new ValidationException('The parameter "id" cant be empty');

	$record		= new record();
	$record->id	= $_REQUEST['id'];

	if( !$record->load() )
	{
		throw new ValidationException('The resource was not found');
	}

	if( empty( $_REQUEST['fullData'] ) || $_REQUEST['fullData'] === 'Y' )
	{
		$apiResponse->setData( $record->toArray() );
	}
	else if( $record->content_type )
	{
		header('Content-type: '.$record->content_type );
		header('Content-Length: '.strlen( $record->data ) );
		echo $record->data;
		exit;
	}
	else
	{
		header('Content-Length: '.strlen( $record->data ) );
		echo $record->data;
		exit;
	}

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
