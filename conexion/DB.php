<?php
namespace Conexion;

use mysqli;


class DB {

    private static $host = 'localhost';
    private static $user = 'root';
    private static $pass = '';
    private static $db = 'alamilla';
    private static $con;


    public static function conection(){
       return self::$con = new mysqli(self::$host, self::$user, self::$pass, self::$db);
    }

}