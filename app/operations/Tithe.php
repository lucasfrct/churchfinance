<?php
namespace app\model\operations;

use app\model\operations\Credit;

class Tithe extends Credit 
{
	public function __construct ( ) {
		echo "<br>construct Tithe<br>";
	}

}