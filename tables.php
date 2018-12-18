<?php

use \akou\DBTable;

class log extends DBTable
{
 	var $id;
 	var $keyword;
 	var $data;
}

class record extends DBTable
{
	var $id;
	var $flags;
	var $keyword;
	var $external_id;
	var $content_type;
	var $created;
	var $updated;
	var $data;
}
