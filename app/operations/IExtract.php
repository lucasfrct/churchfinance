<?php
namespace app\model\operations;

interface IExtract 
{
	public function addExtract ( string $dataInit = null, string $dataFinal = null ): array ;
}