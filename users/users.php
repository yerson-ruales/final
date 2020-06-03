<?php
    include '../connection/connection.php';

    $email = $_SESSION['email'];
    $username = $_SESSION['username'];

    if(empty($_SESSION['email']))
    {
        echo "<script>window.location.href='../index.php';</script>";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
  <title>User</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="background:rgb(49, 45, 45);">
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a href="#" class="navbar-brand">
        <img src="../images/pizzapoint.jpg" height="28" alt="Pizza Point">
    </a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav">
            <a href="../publico/publico.php" class="nav-item nav-link active">Publico</a>
            
            
            <a href="../products/products.php" class="nav-item nav-link">Mis productos</a>
            
                <a href="../products/anadir.php" class="nav-item nav-link">Anadir productos</a>
            <a href="../users/users.php" class="nav-item nav-link">Opciones de usuario</a>
        </div>
        <div class="navbar-nav ml-auto">
            <a href="../logout/logout.php" class="nav-item nav-link">Cerrar sesion (<?php echo $_SESSION['username']?> )</a>
        </div>
    </div>
</nav>
<?php
    if(isset($_POST['update'])){

        $connect = $con;
        
        $Oldpassword = $_POST['CurrentPassword'];
        $Newpassword = $_POST['NewPassword'];
        $ConfirmPassword = $_POST['ConfirmPassword'];
        //$password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "select * from appuser where email='".$email."'
        and password='".$Oldpassword."' ";

        $query = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($query,MYSQLI_ASSOC);
        mysqli_query($con, " update log set quien='". $username."', que='Actualizo la contraseña '");

        if($row){

            if($Newpassword == $ConfirmPassword){

                $query = mysqli_query($connect,"update appuser set username = '".$username."',password = '".$Newpassword."',email = '".$email."' where email = '".$email."' "); 
    
                if($query){
                        echo '<div class="alert alert-success alert-dismissible fade show">
                        <strong>Contraseña</strong> actualizada correctamente.
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>';
                }
                else
                {
                    echo mysqli_error($con);
                }
            }
            else
            {
                    echo '<div class="alert alert-danger alert-dismissible fade show">
                    <strong>La contraseña nueva y su confirmacion </strong> no coincide
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>';
            }
        }
        else
        {
            echo '<div class="alert alert-danger alert-dismissible fade show">
                <strong>Contraseña antigua incorrecta</strong>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>';
        }
    }
?>
<div class="container-fluid" style="padding-top:2rem;padding-bottom:1rem;">
    <form style="height: 500px;" id="registrar" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
        <img src="../images/user_icon.png" style="background:#ccc;" height="150" width="150" class="rounded-circle mx-auto d-block" alt="Cinque Terre"><br>
        <h5 style="color:#fff;" class="col text-center"><?php echo $_SESSION['username']?></h5>
        <div class="form-group">
                <label style="color:#fff;" for="inputPassword">Contraseña actual</label>
                <input type="password" name="CurrentPassword" class="form-control" id="CurrentPassword" placeholder="Contraseña actual" required>
                <div class="invalid-feedback">Please enter your current password to continue.</div>
            </div>
            <div class="form-group">
                <label style="color:#fff;" for="inputPassword">Nueva contraseña</label>
                <input type="password" name="NewPassword" class="form-control" id="NewPassword" placeholder="Nueva contraseña" required>
                <div class="invalid-feedback">Por favor, dijita la nueva contraseña</div>
            </div>
            <div class="form-group">
                <label style="color:#fff;" for="inputPassword">Confirma la nueva contraseña</label>
                <input type="password" name="ConfirmPassword" class="form-control" id="ConfirmPassword" placeholder="Confirma tu nueva contraseña" required>
                <div class="invalid-feedback">Por favor, confirma la nueva contraseña</div>
            </div>
            <button style="font-weight:500;margin-top:2rem;" type="submit" name="update" class="btn btn-danger btn-block">CAMBIAR CONTRASEÑA</button><br>
    </form>
</div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../login/login.js"></script>
</body>
</html>
