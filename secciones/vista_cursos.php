<?php include('../templates/cabecera.php');?>
<?php include('../secciones/cursos.php');?>
    <div class="col-md-5">
        <form action="" method="post">
            <div class="card">
                <div class="card-header">
                    Cursos
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="" class="form-label">ID: </label>
                        <input type="text"
                            class="form-control" name="id" id="id" value="<?php echo $id;?>" aria-describedby="helpId" placeholder="ID del Curso">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Nombre del Curso: </label>
                        <input type="text"
                            class="form-control" name="nombre_curso" value="<?php echo $nombre_curso;?>" id="nombre_curso" aria-describedby="helpId" placeholder="Nombre del Curso">
                    </div>
                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="accion" value="agregar" class="btn btn-primary">Agregar</button>
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
                    <th>NOMBRE DEL CURSO</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listaCursos as $curso){?> <!--Aqui mediante un foreach recorro el arreglo de la varaible $listaCursos que se encuentra en el archivo cursos.php para poder imprimir en la tabla todos los registros-->
                <tr>
                    <td><?php echo $curso['id'];?></td>
                    <td><?php echo $curso['nombre'];?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="id" id="id" value="<?php echo $curso['id']; ?>">
                            <input type="submit" value="Seleccionar" name="accion" class="btn btn-info">
                        </form>
                    </td>
                </tr>
                <?php } ?> 
            </tbody>
        </table>
        
    </div>

<?php include('../templates/pie.php');