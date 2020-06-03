<?php
include '../connection/connection.php';

if (empty($_SESSION['email'])) {
    echo "<script>window.location.href='../index.php';</script>";
}

$products = [];
$sql = "select * from products where user_id='" . $_SESSION['id'] . "'";
$query = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

    $products[] = $row;
}

$categorias = [];
$sql = "select * from categorias";
$query = mysqli_query($con, $sql);
while ($cat = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    $categorias[] = $cat;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Productos</title>
    <!---->
    <link rel="stylesheet" href="../products/style/style.css" />
    <!---->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            color: #fff;
            background: rgb(36, 35, 35);
        }
    </style>
</head>

<body>
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
                <a href="../logout/logout.php" class="nav-item nav-link"> <img src="../images/user.png" width="30px" height="30px" class="rounded-circle" alt="Circular Image">Cerrar sesion (<?php echo $_SESSION['username'] ?> )</a>
            </div>
        </div>
    </nav>

    <?php

    $username = $_SESSION['username'];
    $email = $_SESSION['email'];

    if (isset($_POST['insert'])) {

        $productname = $_POST['productname'];
        $productprice = $_POST['productprice'];
        $tmp_name = $_FILES['productimage']['tmp_name'];
        $org_name = $_FILES['productimage']['name'];

        if (isset($_POST['estado'])) {
            $estado = "checked";
        } else {
            $estado = "";
        }
        $tmp_name = $_FILES['productimage']['tmp_name'];
        $productcategoria = $_POST['categoria'];
        $descripcion = $_POST['productdescripcion'];
        $user_id = $_SESSION['id'];

        move_uploaded_file($tmp_name, "../serverimages/" . $org_name);

        $sql = "insert into products(username,email,productname,productprice,productimage,estado, descripcion,categoria, user_id) 
        VALUES ('" . $username . "','" . $email . "','" . $productname . "','" . $productprice . "','" . $org_name . "','" . $estado . "','" . $descripcion . "','" . $productcategoria . "','" . $user_id . "')";

        $query = mysqli_query($con, $sql);


        
        
        mysqli_query($con, "INSERT INTO `test`.`log` (`quien`, `que`) VALUES ('".$username."', 'añadio el preoducto  ".$productname."');");

        if ($query) {
            echo '<div class="alert alert-success alert-dismissible fade show">
            Producto <strong> insertado </strong>correctamente .
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show">
                Error <strong> registraring </strong>Product.
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>';
            echo mysqli_error($con);
        }

        $products = [];
        $sql = "select * from products where user_id='" . $_SESSION['id'] . "'";
        $query = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

            $products[] = $row;
        }
    }

    if (isset($_GET['id'])) {

        $sql_delete = "delete from products where id = '" . $_GET['id'] . "'";
        $query_delete = mysqli_query($con, $sql_delete);

        if ($query_delete) {
            echo '<div class="alert alert-success alert-dismissible fade show">
            Producto<strong> Eliminado </strong> exitosamente .
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>';
        } else {
            echo mysqli_error($con);
        }
    }

    ?>
    <br>
    <div class="container-fluid">
        <form id="registrar" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
            <div class="form-group">
                <label for="inputEmail">nombre del producto</label>
                <input id="nameofproduct" type="text" name="productname" class="form-control" id="inputEmail" placeholder="nombre del producto" required>
                <div class="invalid-feedback">Please enter a nombre del producto.</div>
            </div>
            <div class="form-group">
                <label for="inputEmail">precio del producto</label>
                <input type="text" name="productprice" class="form-control" id="inputEmail" placeholder="precio del producto" required>
                <div class="invalid-feedback">Please enter a precio del producto.</div>
            </div>
            <div class="form-group">
                <label for="inputEmail">Categoría</label>
                <select class="form-control" name="categoria">

                    <!-- <H1>TEST</H1> -->
                    <?php

                    foreach ($categorias as $categoria) {

                    ?>

                        <option value="<?= $categoria["id"] ?>"> <?= $categoria["nombre"] ?></option>


                    <?php
                    }

                    ?>
                </select>

            </div>

            <div class="form-group">
                <label for="inputEmail">Descripcion</label>
                <input type="text" name="productdescripcion" class="form-control" placeholder="Descripcion del producto" value="" required>
                <div class="invalid-feedback">Por favor, de una descripcion del producto.</div>
            </div>


            <div class="form-group">
                Image : <input type="file" name="productimage" class="form-control" id="inputEmail" class="btn btn-primary" required> <br />
                <div class="invalid-feedback">Please choose an Image.</div>
            </div>

            <div class="custom-control custom-switch">
                <input type="checkbox" name="estado" class="custom-control-input" id="customSwitch1">
                <label class="custom-control-label" for="customSwitch1">Activa si deseas que el producto sea visible</label>
            </div>
            <button type="submit" name="insert" class="btn btn-danger btn-block">AÑADIR PRODUCTO</button>
        </form>
        <br><br>
    </script>-->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../login/login.js"></script>
</body>

</html>
