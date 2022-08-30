<?php
include_once("../configuraciones/bd.php");
$conexionBD=BD::crearInstancia();


// Consultas o Metodos SQL (CRUD) de la tabla de cursos
$id=isset($_POST['id'])?$_POST['id']:'';
$nombre_curso=isset($_POST['nombre_curso'])?$_POST['nombre_curso']:'';
$accion=isset($_POST['accion'])?$_POST['accion']:'';

if($accion!=''){
    switch($accion){
        case 'agregar':
            $sql="INSERT INTO cursos(id,nombre) VALUES (NULL,:nombre_curso)";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':nombre_curso',$nombre_curso);
            $consulta->execute();
        break;

        case 'editar':
            $sql="UPDATE cursos SET nombre=:nombre_curso WHERE id=:id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->bindParam(':nombre_curso',$nombre_curso);
            $consulta->execute();
        break;
        case 'borrar':
            $sql="DELETE FROM cursos  WHERE id=:id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();
        break;
        case 'seleccionar':
            $sql="SELECT * FROM cursos WHERE id=:id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();
            $curso=$consulta->fetch(PDO::FETCH_ASSOC);
            $nombre_curso=$curso['nombre_curso'];
            
        break;
    }
}

// Metodo SQL de mostrar los registros de la tabla Cursos
$consulta=$conexionBD->prepare("SELECT * FROM cursos"); // aqui realizo el query de mostrar los registro de la tabla cursos
$consulta->execute(); // ejecuto el query o la accion
$listaCursos=$consulta->fetchAll(); // en esta variable almaceno todos los registros con el metodo fecthAll()

?>