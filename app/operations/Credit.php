<?php
namespace app\operations;

use app\operations\ICredit;
use app\operations\Token;
use app\crud\Crud as CreditCrud;

class Credit implements ICredit
{
	private $token = null;

	public function __construct ( ) {
		echo "<br>construct Credit<br>";
		$this->token = new Token;
	}

	public function add ( string $value = null ): bool
	{
		$token = $this->token->gerate ( $value );
		$type = 1; 
		$value; 
		$description = "operation of credit";

		$crud = CreditCrud::on ( );
		$res = $crud->create ( 
			"churchfinance.operations", 
			"token, type, value, description", 
			'"'.$token.'","'.$type.'","'.$value.'","'.$description.'"'
		);

		return $res;
	}

}