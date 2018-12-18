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
	if( empty( $_REQUEST['keyword'] ) )
		throw new ValidationException('Keyword can\'t be empty');

	$record->keyword	= $_REQUEST['keyword'];
	$record->data	= is_array( $_REQUEST['data'] ) ? json_encode( $_REQUEST['data'] ) : $_REQUEST['data'];

	if( !empty( $_REQUEST['external_id'] ) )
	{
		$record->external_id	= $_REQUEST['external_id'];
	}

	if( empty( $_REQUEST['action'] ) ||
		(!empty( $_REQUEST['action'] ) && $_REQUEST['action'] == "insert")   )
	{
		if( !$record->insertDb() && empty( $record->external_id ) )
		{
			throw new SystemException('Fails to save');
		}
		else
		{
			$recordUpdate				= new record();
			$recordUpdate->keyword		= $_REQUEST['keyword'];
			$recordUpdate->external_id	= $_REQUEST['external_id'];
			$recordUpdate->setWhereString();
			$recordUpdate->data = is_array( $_REQUEST['data'] ) ? json_encode( $_REQUEST['data'] ) : $_REQUEST['data'];

			if( !$recordUpdate->updateDb() )
			{
				throw new SystemException('Fails to update');
			}
		}
	}
	else if( !$record->insertDb() )
	{
		throw new SystemException('Fails to save 1.1');
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
