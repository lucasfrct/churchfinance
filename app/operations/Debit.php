<?php 
namespace app\operations;

use app\operations\IDebit;

class Debit implements IDebit
{
	public function __construct ( ) {
		echo "<br>construct Debit<br>";
	}

	public function addDebit ( string $key = null, string $value = null ): bool
	{
		return  true;
	}

	public function add ( string $value = null ): bool 
	{
		return $this->addDebit ( "", $value );
	}
}