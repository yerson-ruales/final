<?php

    include '../connection/connection.php';

    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        //$password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "select * from appuser where email='".$email."'
        and password='".$password."' ";

        $query = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($query,MYSQLI_ASSOC);

    if($row){
            
            $_SESSION['id']= $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];

            echo '<div class="alert alert-success alert-dismissible fade show">
            <strong>Login </strong> exitoso.
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>';

            header("location: ../publico/publico.php");
    }
    else{
        echo mysqli_error($con);
        echo '<div class="alert alert-danger alert-dismissible fade show">
                <strong>Usuario o contraseña incorrecta</strong>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    
    <title>Bienvenido</title>
</head>
<body>
    <div class="container">
        <form method="post" class="needs-validation" novalidate>
            <div class="form-group">
                <label for="inputEmail">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" required>
                <div class="invalid-feedback"> Por favor, digite un correo valido.</div>
            </div>
            <div class="form-group">
                <label for="inputPassword">Contraseña</label>
                <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Contraseña" required>
                <div class="invalid-feedback">Por favor, digite una contraseña valida.</div>
            </div>
            <div class="form-group">
                <label class="form-check-label"><input type="checkbox"> Recuerdame</label>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
        </form>
    </div>
    <!-- JS files: jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="login.js"></script>
</body>
</html>
