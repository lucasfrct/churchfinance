<?php
namespace app\model\operations;

use app\model\operations\IExtract;

class Extract implements IExtract 
{
	public function __construct ( ) {
		echo "<br>construct Extract<br>";
	}

	public function addExtract ( string $dateInit = null, string $dateFinal = null ): array
	{
		return Array ( );
	}

	public function add ( string $dateInit = null, string $dateFinal = null ): array 
	{
		return $this->addExtract ( $dateInit, $dateFinal );
	}
}