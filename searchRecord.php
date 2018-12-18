<?php

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
	if( empty( $_REQUEST['external_id'] ) )
		throw new ValidationException('The parameter "external_id" cant be empty');

	$record					= new record();
	$record->keyword		= $_REQUEST['keyword'];
	$record->external_id	= $_REQUEST['external_id'];

	if( !$record->load() )
	{
		throw new ValidationException('The resource was not found');
	}

	$apiResponse->setResult(1);
	$apiResponse->setData( $record->toArray() );
	$apiResponse->output();
}
catch(\Exception $e)
{
	$apiResponse->setError( $e );
	$apiResponse->output();
}

$apiResponse->setMsg('An error occurred please try again later');
$apiResponse->output();
