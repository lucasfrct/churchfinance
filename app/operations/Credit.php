<?php
namespace app\operations;

use app\operations\ICredit;
use app\operations\Token;
use app\crud\Crud;


class Credit implements ICredit
{
	private $token = null;

	public function __construct ( ) {
		echo "<br>construct Credit<br>";
		$this->token = new Token;
	}

	public function add ( string $value = null ): bool
	{
		$token = ( $this->token !== null ) ? $this->token->gerate ( $value ) : 0;
		Crud::on ( Connect::on ( ), Modeldata::on ( ) );
		
		$token; $type = 1; $value; $description = "credit";

		return true; 
	}

}