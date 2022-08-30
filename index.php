<?php
    session_start(); // validamos se se enio algo en el login
    if(isset($_POST)){
        $mensaje='Usuario o Contraseña incorrecta';

        if($_POST['usuario']=='admin' && $_POST['password']='12345678'){
            $_SESSION['usuario']=$_POST['usuario']; // esto es una variable de sesion que le indica a la aplicacion que el usuario ya esta logeado
            header('Location: secciones.php');
        }      
    }
?>


<!doctype html>
<html lang="en">
  <head>
    <title>Aplicacion</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
      <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <br>
                <form action="secciones/index.php" method="post">
                    <div class="card">
                        <div class="card-header">
                            Inicio de Sesion
                        </div>
                        <div class="card-body">
                            
                            <?php if(isset($mensaje)){ ?>
                               <div class="alert alert-danger" role="alert">
                                <strong><?php echo $mensaje;?></strong>
                               </div>
                            <?php } ?>
                            
                            <div class="mb-3">
                            <label for="" class="form-label">Usuario</label>
                            <input type="text"
                                class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="usuario">
                            <small id="helpId" class="form-text text-muted">Escriba su usuario</small>
                            </div>
                            <div class="mb-3">
                            <label for="" class="form-label">Contraseña</label>
                            <input type="password"
                                class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="">
                            <small id="helpId" class="form-text text-muted">Escriba su contraseña</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Ingresar</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
      </div>
    
    
    
    
      
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  </body>
</html>