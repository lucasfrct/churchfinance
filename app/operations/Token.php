<?php
namespace app\operations;

class Token 
{
	public function __construct ( )
	{
		
	}

	public function gerate ( string $base = null ) {
		return sha1 ( \DateTime::createFromFormat ( 'U.u', number_format ( microtime ( true ), 6, '.', '' ) )->format ( "m-d-Y H:i:s.u" ).$base );
	}
		
}