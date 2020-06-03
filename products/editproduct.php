<?php

include '../connection/connection.php';

if (empty($_SESSION['email'])) {
    echo "<script>window.location.href='../index.php';</script>";
}


if (isset($_GET['edit'])) {

    $id = $_GET['edit'];
    $query = mysqli_query($con, "Select id,username,email,productname,productprice,productimage,estado,categoria,descripcion from products where id = $id ");
    $row = mysqli_fetch_array($query, MYSQLI_ASSOC);


    $categorias = [];
    $sql = "select * from categorias";
    $query = mysqli_query($con, $sql);
    while ($cat = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $categorias[] = $cat;
    }

    if ($row) {
        $id = $row['id'];
        $username = $row['username'];
        $email = $row['email'];
        $productname = $row['productname'];
        $productprice = $row['productprice'];
        $productimage = $row['productimage'];
        $productcategoria = $row['categoria'];
        $descripcion = $row['descripcion'];
        $estado = $row['estado'];
    } else {
        echo "Error";
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EDITAR PRODUCTO</title>
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

        section {
            text-align: center;
        }

        th {
            color: #fff;
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
                <a href="../logout/logout.php" class="nav-item nav-link"> <img src="../images/user.png" width="30px" height="30px" class="rounded-circle" alt="Circular Image"> Cerrar sesion ( <?php echo $_SESSION['username'] ?> )</a>
            </div>
        </div>
    </nav>
    <?php
    if (isset($_POST['update'])) {

        $connect = $con;

        $productname = $_POST['productname'];
        $productprice = $_POST['productprice'];
        if (isset($_POST['estado'])) {
            $estado = "checked";
        } else {
            $estado = "";
        }
        $tmp_name = $_FILES['productimage']['tmp_name'];
        $org_name = $_FILES['productimage']['name'];
        $productcategoria = $_POST['categoria'];
        $descripcion = $_POST['productdescripcion'];

        move_uploaded_file($tmp_name, "../serverimages/" . $org_name);
        if ($org_name != "") {

            $sql = "update products set username = '" . $username . "',email = '" . $email . "',productname = '" . $productname . "',productprice = '" . $productprice . "',productimage = '" . $org_name . "',estado = '" . $estado . "',descripcion= '" . $descripcion . "' ,categoria= '" . $productcategoria . "' where id = '" . $id . "'";

        } else {
            
            $sql = "update products set username = '" . $username . "',email = '" . $email . "',productname = '" . $productname . "',productprice = '" . $productprice . "',estado = '" . $estado . "',descripcion= '" . $descripcion . "' ,categoria= '" . $productcategoria . "' where id = '" . $id . "'";
        }
        $query = mysqli_query($connect, $sql);

        mysqli_query($connect, "INSERT INTO `test`.`log` (`quien`, `que`) VALUES ('".$username."', 'actualizo el produycto ".$productname."');");
        // sleep(2);
        if ($query) {
            echo '<div class="alert alert-success alert-dismissible fade show">
              Producto<strong> actualizado </strong>exitosamente.
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              </div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show">
                  Error <strong> actualizando </strong>.
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  </div>';
        }
    }
    ?>
    <br>
    <div class="container-fluid">
        <form id="registrar" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
            <div class="form-group">
                <label for="inputEmail">nombre del producto</label>
                <input id="nameofproduct" type="text" name="productname" class="form-control" id="inputEmail" placeholder="nombre del producto" value="<?php echo $productname ?>" required>
                <div class="invalid-feedback">Please enter a nombre del producto.</div>
            </div>
            <div class="form-group">
                <label for="inputEmail">precio del producto</label>
                <input type="text" name="productprice" class="form-control" placeholder="precio del producto" value="<?php echo $productprice ?>" required>
                <div class="invalid-feedback">Please enter a precio del producto.</div>
            </div>
            <div class="form-group">
                <label for="inputEmail">Categoría</label>
                <select class="form-control" name="categoria">

                    <!-- <H1>TEST</H1> -->
                    <?php

                    foreach ($categorias as $categoria) {

                    ?>

                        <option value="<?= $categoria["id"] ?>" <?= ($productcategoria == $categoria["id"]) ? "selected" : "" ?>> <?= $categoria["nombre"] ?></option>


                    <?php
                    }

                    ?>
                </select>

            </div>

            <div class="form-group">
                <label for="inputEmail">Descripcion</label>
                <input type="text" name="productdescripcion" class="form-control" placeholder="Descripcion del producto" value="<?php echo $descripcion ?>" required>
                <div class="invalid-feedback">Por favor, de una descripcion del producto.</div>
            </div>
            <div class="form-group">
                Image : <input type="file" name="productimage" class="form-control" class="btn btn-primary" value=""> <br />
                <!-- <div class="invalid-feedback">Please choose an Image.</div> -->
            </div>
            <div class="custom-control custom-switch">
                <input type="checkbox" name="estado" <?php echo $estado ?> class="custom-control-input" id="customSwitch1">
                <label class="custom-control-label" for="customSwitch1">Activa si deseas que el producto sea visible</label>
            </div>

            <button type="submit" name="update" class="btn btn-danger btn-block">Editar producto</button><br>
            <!--<a class="btn btn-danger btn-block" href="products.php">BACK</a><br/>-->
        </form>
        <!--<section>
<div class="table-responsive text-nowrap">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Product Image</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><img src="../serverimages/<?php /*echo $productimage*/ ?>" style="width:30%;" ></td>
            </tr>
          </tbody>
        </table>
      </div>
</section>-->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../login/login.js"></script>
</body>

</html>
