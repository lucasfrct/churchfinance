<?php
include_once ( "app/autoload.php" );

use app\operations\Credit as Credit;
use app\operations\Debit as Debit;
use app\operations\Extract as Extract;
use app\operations\MonthlyReport as Month;
use app\operations\Offer as Offer;
use app\operations\Tithe as Tithe;

$credit = new Credit;
echo $credit->add ( "200" );

