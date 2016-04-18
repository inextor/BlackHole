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
	$sqlKeywords	= 'SELECT DISTINCT keyword FROM record';
	$resKeywords	= DBTable::$connection->query( $sqlKeywords );

	if( !$resKeywords )
		throw new SystemException('Fail to retrieve keywords', $sqlKeywords );

	$keywords	= array();
	while( $row = $resKeywords->fetch_object() )
	{
		$keywords[] = $row->keyword;
	}

	$apiResponse->setData( $keywords );
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
