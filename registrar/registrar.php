<?php

    include '../connection/connection.php';
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" >
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    
    <title>Registrarse</title>
</head>
<body>
    <?php 
        if (isset($_POST['insert'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $celular = $_POST['celular'];
            $whatsapp = $_POST['whatsapp'];
            $direccion = $_POST['direccion'];
            $ciudad = $_POST['ciudad'];
            
            //$password = password_hash($password, PASSWORD_DEFAULT);
    
            $sql = "insert into appuser(username,password,email,celular,whatsapp,direccion,ciudad)
            VALUES ('".$username."','".$password."','".$email."','".$celular."','".$whatsapp."','".$direccion."','".$ciudad."')";
            
            $query=mysqli_query($con,$sql);
            
            mysqli_query($con, " update log set quien='". $username."', que='Se registro en el sistema'");
            if($query){
            echo '<div class="alert alert-success alert-dismissible fade show">
            Usuario <strong> Registrado </strong> exitosamente. <a href="../ "> Ir a login </a>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>' 
            ;
            }else{
                echo '<div class="alert alert-danger alert-dismissible fade show">
                Ya existe un <strong> usuario </strong>registrado con el mismo email.
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>';
            }  
        }
    ?>
    <br/>
    <div class="container">
        <div><a href="../"> ir a inicio</a>
        <form style="height: 740px;margin:auto !important" id="registrar" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
        <div class="form-group">
                <label for="inputEmail">Nombre completo</label>
                <input type="text" name="username" class="form-control" autofocus id="inputEmail" placeholder="Nombre" required>
                <div class="invalid-feedback">por favor, digita un username.</div>
            </div>
            <div class="form-group">
                <label for="inputEmail">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" required>
                <div class="invalid-feedback">por favor, digita un correo valido.</div>
            </div>
            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password" required>
                <div class="invalid-feedback">por favor, digita  tu password para continuar.</div>
            </div>
            <div class="form-group">
                <label for="inputCelular">Celular</label>
                <input type="text" name="celular" class="form-control" id="inputCelular" placeholder="Celular" required>
                <div class="invalid-feedback">por favor, digita  tu celular para continuar.</div>
            </div>
            <div class="form-group">
                <label for="inputWhatsApp">WhatsApp</label>
                <input type="text" name="whatsapp" class="form-control" id="inputWhatsApp" placeholder="WhatsApp" required>
                <div class="invalid-feedback">por favor, digita  tu whatsapp para continuar.</div>
            </div>
            <div class="form-group">
                <label for="inputDireccion">Direccion</label>
                <input type="text" name="direccion" class="form-control" id="inputDireccion" placeholder="Direccion" required>
                <div class="invalid-feedback">por favor, digita  tu password para continuar.</div>
            </div>
            <div class="form-group">
                <label for="inputCiudad">Ciudad</label>
                <input type="text" name="ciudad" class="form-control" id="inputCiudad" placeholder="Ciudad" required>
                <div class="invalid-feedback">por favor, digita  tu password para continuar.</div>
            </div>
            <button style="margin-top:1rem;" type="submit" name="insert" class="btn btn-danger">registrar</button><br>
            <!--<a class="btn btn-danger btn-block" href="../publico/publico.php">BACK</a>-->
        </form>
    </div>
    <!-- JS files: jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../login/login.js"></script>
</body>
</html>
