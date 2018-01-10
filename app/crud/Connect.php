<?php
#Connect.php

class Connect 
{

	# Instância única 
	private static $instance = null;
	private $host = array( "host"=> "127.0.0.1", "port"=> "3306", "user"=> "root", "password"=> "" );
	private $database = "churchfinance";
	private $mysqli = null;
	private $message = Array ( );
	private $exception = Array ( );

	# Testa se o servidor esta online
	private function onServer ( string $host = "", string $port = "" ) : bool 
	{
		$onServer = false;

		try {
			$server = @fsockopen ( $host, $port, $errCode, $errStr, 1 );
			
			if ( $server == true ) {
				@fclose ( $server );
				$onServer = true;
				array_push( $this->message, "Server On-line: ".$host.":".$port );
			} else {
				$onServer = false;
				array_push( $this->message, "Server Off-line: ".$host.":".$port );
			};

		} catch ( Exception $error ) {
            array_push ( $this->exceptions, $error );
		};

		return $onServer;
	}

	# Abre connecxão Mysqli
	private function open ( ) 
	{

		try {
			self::$instance->mysqli = @new mysqli (
				self::$instance->host [ "host" ].":".self::$instance->host [ "port" ], 
				self::$instance->host [ "user" ], 
				self::$instance->host [ "password" ], 
				self::$instance->database 
			);
			
			if ( !self::$instance->mysqli->connect_error && !mysqli_connect_errno ( ) ) {
				self::$instance->mysqli->set_charset( "utf8" );
				array_push ( self::$instance->message, "Open Connect Mysqli." );
			} else {
				array_push ( self::$instance->message, "Error Connect Mysqli: ".self::$instance->mysqli->connect_error );
			};

		} catch ( Exception $exception ) {
			array_push ( self::$instance->exception, $exception );
		};

		return self::$instance->mysqli;
	}

	# inicia uma instancia da classe ConnectMysqli
	public static function on ( ): Mysqli 
	{

		#inicia uma instância se necessário
		if ( self::$instance === null ) { 
			self::$instance = new Connect;
			array_push ( self::$instance->message, "New Instance Connect" );
		};

		$inst = self::$instance;

		if ( $inst !== null && $inst->onServer ( $inst->host [ "host" ], $inst->host [ "port" ] ) ) {;
			$inst->open ( );
		};
		
        return self::$instance->mysqli;
	}

	# fecha connexão mysqli 
	private function close ( ) 
	{
		if ( self::$instance->mysqli->close ( ) ) {
			array_push ( self::$instance->message, "Close connect Mysqli." );
		} else {
			array_push ( self::$instance->message, "Error close connect Mysqli." );
		};
	}

	# encerra a instancia da classe ConnectMysqli
	public static function off ( ) 
	{
		self::$instance->close ( );
		array_push ( self::$instance->message, "Off instance Connect" );
		return self::$instance = null;
	}

	# reprota mensagens de status, mensagems, erros,excessões e logs
	public static function report ( ): string 
	{
		# return = { status: true, errors: 01, message: [ ], exceptions: [ ], }

		$report = array ( 
			"message" => self::$instance->message,
			"exception" => self::$instance->exception,
		);

		self::$instance->message = array ( );

		return json_encode ( $report );
	}

	# Protetor Singletom na Construção da classe
	private function __construct ( ) { }

	# Protetor Simgleton na colnagem da classe
	private function __clone ( ) { }

	# Protetor Simgleton contra o despertar da classe
	private function __wakeup ( ) { }
};

#echo Connect::on ( )->query ( "INSERT INTO users ( name, email, emailSecurity, password ) VALUES ( 'Name', 'Email 1', 'email Sec', 'Pass' )" );
#echo Connect::report ( );
#echo Connect::off ( );