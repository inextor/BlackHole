<?php

/**
 * addLog.php:
 * @param keyword, message.
 * @return response object.
 */

include_once( __DIR__.'/api.php' );
include_once( __DIR__.'/tables.php');



include_once( __DIR__.'/json-stream/Exception/ParsingError.php');
include_once( __DIR__.'/json-stream/Exception/WritingError.php');
include_once( __DIR__.'/json-stream/Writer.php');

use Bcn\Component\Json\Writer;



use \akou\ApiResponse;
use \akou\DBTable;
use \akou\Utils;
use \akou\LoggableException;
use \akou\SystemException;
use \akou\ValidationException;

$apiResponse	= new ApiResponse();

try
{
	$sqlKeywords	= 'SELECT id,keyword,external_id,flags,content_type,created,updated,data FROM record WHERE keyword ="'.DBTable::escape( $_REQUEST['keyword'] ).'"';
	$resKeywords	= DBTable::query( $sqlKeywords );

	if( !$resKeywords )
		throw new SystemException('Fail to retrieve keywords', $sqlKeywords );


	$fh		= fopen('php://output','w');
	$writer = new Writer($fh);

	$writer->enter(Writer::TYPE_OBJECT);     			// enter root object
	$writer->write("result", 1);      					// write key-value entry
	$writer->write("timestamp", date("Y-m-d H:i:s") );  // enter items array
	$writer->write("msg","");
	$writer->write("code","");
	$writer->enter("data", Writer::TYPE_ARRAY);    		// enter items array


	$row_header	= array();
	$stmt		= DBTable::getStmtBindRawRowResult( $sqlKeywords ,$row, $row_header );
	//$writer->write(null, $row_header);
	$i			= 0;

	while( $stmt->fetch() )
	{

		$obt	= array
		(
			'id'			=> $row[0]
			,'keyword'		=> $row[1]
			,'external_id'	=> $row[2]
			,'flags'		=> $row[3]
			,'content_type'	=> $row[4]
			,'created'		=> $row[5]
			,'updated'		=> $row[6]
		  ,'data'			=> $row[7]
		);
		$writer->write(null, $obt , Writer::TYPE_OBJECT);

		if( (($i++) % 100)===0 )
			fflush( $fh );
	}

	$stmt->close();
	$writer->leave();      // leave items array
	$writer->leave();      // leave root object

	fflush( $fh );
	fclose( $fh );
	exit;
}
catch(\Exception $e)
{
	$apiResponse->setError( $e );
	$apiResponse->output();
}

$apiResponse->setMsg('An error occurred please try again later');
$apiResponse->output();

