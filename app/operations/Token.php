<?php
namespace app\operations;

class Token 
{
	public function __construct ( )
	{
		
	}

	public function gerate ( string $base = null ) {
		return sha1 ( date ( DATE_ATOM, mktime ( 0, 0, 0, 7, 1, 2000 ) ).$base );
	}
		
}