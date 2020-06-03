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

        
        mysqli_query($con, " update log set quien='". $username."', que='inserto el producto '".$productname."'");

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
    
        <br><br>
        <h2 style="width:100%;text-align:center;">Tus productos</h2>
        <br>
        <!--
        <section>
        <div class="horizontal">
           <div class="table">
               <article >
               <?php foreach ($products as $product) : ?>
                    <?php
                    /*$id = $product['id'];
                        $name = $product['productname'];
                        $price = $product['productprice'];
                        $image = $product['productimage'];
                        $user = $product['username'];
                        //
                        echo "<br/><br/><p id='id' style='color:red; display:none'>$id</p>";
                        echo "<p id='user' style='color:red; display:none'>$user</p>";
                        echo "<p id='productname'>nombre del producto : $name</p>";
                        echo "<p id='productprice'>precio del producto : $price</p>";*/

                    echo '<br/><br/> nombre del producto : ' . $product['productname']
                        . '<br/><br/> precio del producto : ' . $product['productprice']
                        . '<br/><br/> user uploaded : ' . $product['username'] . '<br/><br/>';
                    ?>
                    <img class="mySlides" src="../serverimages/<?php echo $product['productimage'] ?>" style="width:100%;"><br><br>
                    <a class="btn btn-danger btn-block" href="editproduct.php?edit=<?php echo $product['id'] ?>">EDITAR PRODUCTO</a><br/>
                    <a class="btn btn-danger btn-block" href="?id=<?php echo $product['id'] ?>">ELIMINAR PRODUCTO</a>
               <?php endforeach ?>
               </article>
           </div>
        </div>
        </section>-->
        <div class="table-responsive text-nowrap">
            <!--Table-->
            <table id="table1" class="table table-bordered table-dark table-hover">
                <!--Table head-->
                <thead>
                    <tr>
                        <th>Nombre del producto</th>
                        <th>Precio del producto</th>
                        <th>Imagen del producto</th>
                        <th>Editar producto</th>
                        <th>Editar producto</th>
                    </tr>
                </thead>
                <!--Table head-->
                <!--Table body-->
                <tbody>
                    <?php foreach ($products as $product) : ?>
                        <tr>
                            <td style="width:20%;"><?php echo $product['productname'] ?></td>
                            <td style="width:20%;"><?php echo $product['productprice'] ?></td>
                            <td style="width:20%;text-align:center;"><img width="300px" src="../serverimages/<?php echo $product['productimage'] ?>"></td>
                            <td style="width:20%;"><a class="btn btn-danger btn-block" href="editproduct.php?edit=<?php echo $product['id'] ?>">EDITAR PRODUCTO</a></td>
                            <td style="width:20%;"><a class="btn btn-danger btn-block" href="?id=<?php echo $product['id'] ?>">ELIMINAR PRODUCTO</a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <!--Table body-->
            </table>
            <!--Table-->
        </div>
        <br><br><br>
        <!---->
    </div>
    <!--<script type="text/javascript" src="../products/js/html5shiv.js"></script>
    <script type="text/javascript" src="../products/js/jquery.js"></script>
    <script type="text/javascript" src="../products/js/enscroll-0.4.2.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            $('.horizontal').enscroll({
                horizontalTrackClass: 'horizontal-track2',
                horizontalHandleClass: 'horizontal-handle2',
                verticalScrolling: false,
                horizontalScrolling: true,
                addPaddingToPane: true
            });
            
        });
    </script>-->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../login/login.js"></script>
</body>

</html>
