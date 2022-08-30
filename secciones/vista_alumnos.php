<?php include('../templates/cabecera.php');?>
<?php include('../secciones/alumnos.php');?>
    <div class="row">
        <div class="col-md-5">
            <form action="" method="post">
               <div class="card">
                <div class="card-header">
                    Alumnos
                </div>
                <div class="card-body">
                    <div class="mb-3">
                      <label for="" class="form-label">ID:</label>
                      <input type="text"
                        class="form-control" name="id" id="id" value="<?php echo $id;?>" aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label">Nombre:</label>
                      <input type="text"
                        class="form-control" name="nombre_alumno" id="nombre_alumno" value="<?php echo $nombre;?>" aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label">Apellidos:</label>
                      <input type="text"
                        class="form-control" name="apellido_alumno" id="apellido_alumno" value="<?php echo $apellidos;?>" aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label">Curso del Alumno</label>
                      <select multiple class="form-control" name="cursos[]" id="listaCursos">
                      <?php
                            foreach($cursos as $curso){?>
                                 <option 
                                 <?php 
                                    if(!empty($arregloCursos="")):
                                        if(in_array($curso['id'],$arregloCursos)):
                                            echo 'selected';
                                        endif;
                                    endif;

                                 ?>
                                 value="<?php  echo $curso['id'];?>"> 
                                 <?php  echo $curso['id'];?>- <?php echo $curso['nombre'];?> 
                                </option>
                            <?php } ?>
                      </select>
                    </div>
                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="accion" value="agregar" class="btn btn-success">Agregar</button>
                        <button type="submit" name="accion" value="editar" class="btn btn-warning">Editar</button>
                        <button type="submit" name="accion" value="borrar" class="btn btn-danger">Borrar</button>
                    </div>
                </div>
               </div> 
            </form>
        </div>
        <div class="col-md-7">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($alumnos as $estudiante){?> <!--Aqui mediante un foreach recorro el arreglo de la varaible $alumnos que se encuentra en el archivo cursos.php para poder imprimir en la tabla todos los registros-->
                        <tr>
                            <td><?php echo $estudiante['id'];?></td>
                            <td>
                                <?php echo $estudiante['nombre'];?> <?php echo $estudiante['apellidos'];?>
                                <?php 
                                    foreach($estudiante["cursos"] as $curso){?>
                                        <br>
                                        - <a href="certificado.php?id_curso=<?php echo $curso['id'];?>&id_alumno=<?php echo $estudiante['id']?>"> <?php echo $curso['nombre'];?></a> <br> <!-- aqui en el href estoy mandao al archivo certificado pero a la direccion le mando los parametros del id de curso correspondiente y del id del alumno iguamente correspoindiente-->
                                    <?php }?>
                            </td>
                            <td>
                                <form action="" method="post">
                                <input type="hidden" name="id" id="id" value="<?php echo $estudiante['id']; ?>">
                                <input type="submit" value="Seleccionar" name="accion" class="btn btn-info">
                        </form>
                            </td>
                        </tr>
                    <?php } ?> 
                </tbody>
            </table>
            
        </div>
    </div>

<link href="https://cdn.jsdelivr.net/npm/tom-select@2.1.0/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.1.0/dist/js/tom-select.complete.min.js"></script>

<script>
    new TomSelect('#listaCursos'); // esto es unicamente para mejorar el selector de los cursos no es necesario poner solo es para que se vea bien usando una libreria
</script>
<?php include('../templates/pie.php');?>