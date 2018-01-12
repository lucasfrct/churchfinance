<?php
#Conn.php
namespace app\crud;

class Conn 
{
    private static $instance;
    private static $mysqli = null;
    private static $result = null;
    public static $error = Array ( );

    private function __construct ( ) { }
    private function __wakeup ( ) { }
    private function __clone ( ) { }

    public static function on ( ) 
    {
        if ( null === self::$instance  ) {
            self::$instance = new Conn ( );
            self::$mysqli = mysqli_connect ( '127.0.0.1', 'root', '' );
            
            array_push ( self::$error, mysqli_report ( MYSQLI_REPORT_OFF ) );
            
            if( mysqli_connect_errno ( ) ) {
                array_push ( self::$error, mysqli_connect_error ( ) );
                array_push ( self::$error, mysqli_connect_errno ( ) );
            };
        };

        return self::$instance;
    }

    public function query ( string $sql = null ) 
    {
        if ( null !== $sql ) {
            self::$result = self::$mysqli->query ( $sql );
        };

        return self::$result;
    }

    public function fetch_assoc ( $result = null ) 
    {   
        self::$result = ( null !== $result ) ? $result : self::$result;
        return mysqli_fetch_assoc ( self::$result );
    }
}