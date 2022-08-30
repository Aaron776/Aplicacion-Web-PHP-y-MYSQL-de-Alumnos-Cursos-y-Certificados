<?php
    require("../librerias/fpdf/fpdf.php");
    include_once("../configuraciones/bd.php");
    $conexionBD=BD::crearInstancia();
    
    function agregarTexto($pdf,$texto,$x,$y,$align='L',$fuente,$size=10,$r=0,$g=0,$b=0){ // funcion para agregar estilos a nuestro pdf
        $pdf->SetFont($fuente,"",$size);
        $pdf->SetXY($x,$y);
        $pdf->SetTextColor($r,$g,$b);
        $pdf->Text($x,$y,$texto);   
        $pdf->Cell(0,10,$texto,0,0,$align); 
    }

    function agregarImagen($pdf,$imagen,$x,$y){ // funcion para agregar estilos a nuestro pdf
        $pdf->Image($imagen,$x,$y,0);
    }

    //print_r($_GET);
    $idCurso=isset($_GET['id_curso'])?$_GET['id_curso']:""; // aqui recibo la informacion del id de curso 
    $idAlumno=isset($_GET['id_alumno'])?$_GET['id_alumno']:"";// aqui recibo la informacion del id de alumno 
    
    $sql="SELECT alumnos.nombre,alumnos.apellidos,cursos.nombre  FROM alumnos,cursos where alumnos.id=:idAlumno AND cursos.id=:idCurso";
    $consulta=$conexionBD->prepare($sql);
    $consulta->bindParam(':idAlumno',$idAlumno);
    $consulta->bindParam(':idCurso',$idCurso);
    $consulta->execute();
    $alumno=$consulta->fetch(PDO::FETCH_ASSOC);
    
    
    
    $pdf = new FPDF("L","mm",array(350,194)); // creacion del pedf usando una libreria que descargamos
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    agregarImagen($pdf,"../src/certificado_.jpg",0,0);
    agregarTexto($pdf,ucwords(utf8_decode($alumno['nombre']." ".$alumno['apellidos'])),110,-115,'C',"Helvetica",30,0,84,115);
    agregarTexto($pdf,$alumno['nombre'],110,-65,'C',"Helvetica",30,0,84,115);
    $pdf->Output();

    
    

?>  