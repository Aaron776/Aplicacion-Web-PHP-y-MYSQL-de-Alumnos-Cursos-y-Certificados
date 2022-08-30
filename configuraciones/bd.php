<?php
class BD{
    public static $instancia=null;
    public static function crearInstancia(){
        if(!isset(self::$instancia)){
            $opciones[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
            self::$instancia=new PDO("mysql:host=localhost;dbname=aplicacion_cursos","root","",$opciones); //aqui realizo la conexion a la base de datos
            //echo "Conexion Exitosa";
        }
        return self::$instancia;
    }
}

?>