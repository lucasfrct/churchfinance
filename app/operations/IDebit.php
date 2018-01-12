<?php
namespace app\operations;

interface IDebit
{
	public function add( string $value = null ): bool;
}