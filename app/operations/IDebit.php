<?php
namespace app\operations;

interface IDebit
{
	public function addDebit ( string $key = null, string $value = null ): bool;
}