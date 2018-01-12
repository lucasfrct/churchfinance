<?php
namespace app\operations;

use app\operations\ICredit;
use app\operations\Token;
use app\crud\Connect;

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
		$token; $type = 1; $value; $description = "credit";

		$conn = Connect::on ( );
		$res = $conn->query ( "SHOW DATABASES" );
		while ( $row = $res->fetch_assoc ( ) ) {
			echo "<br> conn - ".$row["Database"];
		}

		

		return true; 
	}

}