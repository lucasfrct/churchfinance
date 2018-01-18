<?php
include_once ( "app/autoload.php" );

use app\crud\Crud as Crud;

if ( $_SERVER [ "REQUEST_METHOD" ] == 'POST' ) {
	$crud = Crud::on ( );
	$crud->digestJson ( json_encode ( $_POST ) );
	$crud->run ( );
	echo $crud->response ( );	
};

