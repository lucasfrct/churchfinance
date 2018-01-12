<?php 
namespace app\operations;

use app\operations\IDebit;
use app\operations\Token;
use app\crud\Crud as DebitCrud;

class Debit implements IDebit
{
	private $token = null;
	public function __construct ( ) {
		echo "<br>construct Debit<br>";
		$this->token = new Token;
	}

	public function add ( string $value = null ): bool 
	{
		$token = $this->token->gerate ( $value );
		$type = 0; 
		$value; 
		$description = "operation of credit";

		$crud = DebitCrud::on ( );
		$res = $crud->create ( 
			"churchfinance.operations", 
			"token, type, value, description", 
			'"'.$token.'","'.$type.'","'.$value.'","'.$description.'"'
		);

		return $res;
	}
}