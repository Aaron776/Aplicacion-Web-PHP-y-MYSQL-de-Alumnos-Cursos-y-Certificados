<?php
include_once("../configuraciones/bd.php");
$conexionBD=BD::crearInstancia();



$accion=isset($_POST['accion'])?$_POST['accion']:''; 
$id=isset($_POST['id'])?$_POST['id']:''; // esto es la validacion que no esten vacios del formulario de alumnos
$nombre=isset($_POST['nombre_alumno'])?$_POST['nombre_alumno']:'';
$apellidos=isset($_POST['apellido_alumno'])?$_POST['apellido_alumno']:'';
$cursos=isset($_POST['cursos'])?$_POST['cursos']:'';

// Consultas o Metodos SQL (CRUD) de la tabla de alumnos
if($accion!=''){
    switch($accion){
        case 'agregar':
            $sql="INSERT INTO alumnos(id,nombre,apellidos) VALUES (NULL,:nombre,:apellidos)";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':nombre',$nombre);
            $consulta->bindParam(':apellidos',$apellidos);
            $consulta->execute();

            $idAlumnoInsertado=$conexionBD->lastInsertId();

            foreach($cursos as $curso){
                $sql="INSERT INTO alumnos_cursos (id,id_alumno,id_curso) VALUES (NULL,:id_alumno,:id_curso)" ;
                $consulta=$conexionBD->prepare($sql);
                $consulta->bindParam(':id_alumno',$idAlumnoInsertado);
                $consulta->bindParam(':id_curso',$curso);
                $consulta->execute();
            }
        break;

        case 'editar':
            $sql="UPDATE alumnos SET nombre=:nombre,apellidos=:apellidos WHERE id=:id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->bindParam(':nombre',$nombre);
            $consulta->bindParam(':apellidos',$apellidos);
            $consulta->execute();

            if(isset($cursos)){
                $sql="DELETE FROM alumnos_cursos WHERE id_alumno=:id_alumno";
                $consulta=$conexionBD->prepare($sql);
                $consulta->bindParam(':id_alumno',$id);
                $consulta->execute();

                foreach($cursos as $curso){
                    $sql="INSERT INTO alumnos_cursos (id, id_alumno, id_curso) VALUES(id,:id_alumno,:id_curso)";
                    $consulta=$conexionBD->prepare($sql);
                    $consulta->bindParam(':id_alumno',$id);
                    $consulta->bindParam(':id_curso',$curso);
                    $consulta->execute();

                }

                $arregloCurso[]=$cursos;
            }
        break;
        case 'borrar':
            $sql="DELETE FROM alumnos  WHERE id=:id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();
        break;
        case 'seleccionar':
            $sql="SELECT * FROM alumnos WHERE id=:id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();
            $alumno=$consulta->fetch(PDO::FETCH_ASSOC);
            $apellidos=$alumno['apellidos'];
            $nombre=$alumno['nombre'];
            
            $sql="SELECT cursos.id FROM alumnos_cursos INNER JOIN cursos ON cursos.id=alumnos_cursos.id_curso WHERE alumnos_cursos.id_alumno";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':id_alumno',$id);
            $consulta->execute();
            $cursosAlumnos=$consulta->fetch(PDO::FETCH_ASSOC);

            foreach($cursosAlumnos as $curso){
                $arregloCursos[]=$curso['id'];

            }
        break;
    }
}



$sql="SELECT * FROM alumnos";
$listaAlumnos=$conexionBD->query($sql);
$alumnos=$listaAlumnos->fetchAll();

foreach($alumnos as $clave => $estudiante){
    $sql="SELECT * FROM cursos WHERE id IN(SELECT id_curso FROM alumnos_cursos WHERE id_alumno=:id_alumno)";
    $consulta=$conexionBD->prepare($sql);
    $consulta->bindParam(':id_alumno',$estudiante['id']);
    $consulta->execute();
    $cursosAlumnos=$consulta->fetchAll();
    $alumnos[$clave]['cursos']=$cursosAlumnos;
}

$sql="SELECT * FROM cursos";
$listaCursos=$conexionBD->query($sql); // ejecuto aqui la consulta y la guardo en una variable
$cursos=$listaCursos->fetchAll(); // aqui traigo a todos los registros de la tabla usando el fecthAll() y alamceno en una variable


?>