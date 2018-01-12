<?php
#Crud.php
namespace app\crud;

require_once ( "Connect.php" );
require_once ( "Modeldata.php" );

class Crud
{
    private static $instance = null;
    private $connect = null;
    private $model = null;
    private $data = null;
    private $response = null;

    public static function on ( $connect = null, Modeldata $model = null ): Crud 
    {

        if ( self::$instance === null && $connect !== null ) { 
            self::$instance = new Crud;
        };

        if ( self::$instance !== null ) {
            self::$instance->connect = $connect;
            self::$instance->model = $model;
        };

        return self::$instance;
    }

    public function create ( string $table = null, string $fields = null, string $values = null ): bool {
        if ( !empty ( $table ) && !empty ( $fields ) && !empty ( $values ) ) {
            return ( 
                self::$instance->connect->query (  
                    "INSERT INTO {$table} ( {$fields} ) VALUES ( {$values} )" 
                ) 
                && self::$instance->connect->affected_rows > 0 
            ) ? true : false;
        };
    } 

    public function read ( string $table = null, string $fields = "*", string $condition = "" ): array 
    {
        if ( !empty ( $table ) ) {
            $rows = array ( );
            $condition = ( empty ( $condition ) ) ? "WHERE" : $condition." AND ";
            $result = self::$instance->connect->query ( 
                "SELECT {$fields} FROM {$table} {$condition} enable=true", 
                MYSQLI_USE_RESULT 
            );

            while ( $row = $result->fetch_assoc ( ) ) {  
                array_push ( $rows, $row ); 
            };
            return $rows;
        };
    }

    public function update ( string $table = null, string $set = "", string $condition = "" ): bool 
    {
        if ( !empty ( $table ) && !empty ( $set ) && !empty ( $condition ) ) {
            return  ( 
                self::$instance->connect->query ( "UPDATE {$table} SET {$set} {$condition}" )
                && self::$instance->connect->affected_rows > 0 
            ) ? true : false;
        };
    }

    public function delete ( string $table = null, string $condition = null ): bool 
    {
        return self::$instance->update ( $table, "enable='false'", $condition );
    }

    public function digestJson ( string $data = null ): array {
        return self::$instance->data = self::$instance->model->digest ( $data );
    }

    public function run ( ): string 
    {

        $ins = self::$instance;
        $action = $ins->data [ "action" ];
        $table = $ins->data [ "table" ];
        $data = ( !empty ( $ins->data [ "data" ] ) ) ? $ins->data [ "data" ] : null;
        $fields = ( !empty ( $ins->data [ "fields" ] ) ) ? $ins->data [ "fields" ] : null;
        $id = ( !empty ( $ins->data [ "id" ] ) ) ? $ins->data [ "id" ] : null;

        switch ( $action ) {
            case "create":
                $parse = $ins->model->parseJsonToFieldsAndValues ( $data );
                $ins->response = json_encode ( $ins->create ( $table, $parse [ "fields" ], $parse [ "values" ] ) );
                break;
            case "read":
                $condition = ( $id == "*"|| $id == "" ) ? " id > 0" :  "id={$id}";
                $ins->response = json_encode ( $ins->read ( $table, $fields, "WHERE {$condition}" ) );
                break;
            case "update":
                $data = $ins->model->parseJsonToItem ( $data );
                $condition = ( $id == "*"|| $id == "" ) ? "" : "WHERE id={$id}";
                $ins->response = json_encode ( $ins->update ( $table, $data, $condition ) );
                break;
            case "delete": 
                $condition = ( $id == "*"|| $id == "" ) ? "" : "WHERE id={$id}";
                $ins->response = json_encode ( $ins->delete ( $table, $condition ) );
                break;
            default:
                break;
        };

        return self::$instance->response;
    }

    public function response ( ): string 
    {
        return self::$instance->response;
    }

    private function __construct ( ) { }
    
    private function __clone ( ) { }
    
    private function __wakeup ( ) { }  
};

#$create = '{ "action": "create", "table":"crud.address", "data": { "idUser": "1", "street":"street1", "city": "city1", "country":"country1" } }';
#$read = '{ "action": "read", "table":"crud.address", "fields": "*", "id": "" }';
#$update = '{ "action": "update", "table":"crud.address", "data":{ "street":"s2", "city":"c2" }, "id":"1" }';
#$delete = '{ "action": "delete", "table": "crud.address", "id":"3" }';
#$crud = Crud::on ( Connect::on ( ), Modeldata::on ( ) );
#$crud->digestJson ( $create );
#echo $crud->run ( );
#echo $crud->response ( );
#echo $crud->create ( $table, $fields, $values );
#echo $crud->read ( $table, $fields, $condition );
#echo $crud->update ( $table, $set, $condition ); // $set = 'field="value",field="value"'
#echo $crud->delete ( $table, $condition );