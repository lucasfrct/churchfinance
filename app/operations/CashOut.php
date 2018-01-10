<?php 
namespace app\model\operations;

use app\model\operations\Debit;

class CashOut extends Debit
{
	public function __construct ( ) 
	{
		echo "<br>initial CashOut<br>";
	}
	
}