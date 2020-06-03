<?php

include '../connection/connection.php';

// if (empty($_SESSION['email'])) {
//     echo "<script>window.location.href='../index.php';</script>";
// }

$products = [];

$sql = "SELECT * FROM products INNER JOIN appuser ON appuser.id= products.user_id  AND products.estado='checked'";
$query = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    $products[] = $row;
}

if (isset($_POST['search'])) {

    $searchtext = $_POST['searchtext'];
    $products = [];
    $sql = "select * from products INNER JOIN appuser ON appuser.id= products.user_id  AND products.estado='checked' where productname = '" . $searchtext . "' ";
    $query = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $products[] = $row;
        foreach ($products as $product) {
            //echo $product['productname'];
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>publico</title>
    <link rel="stylesheet" href="../publico/style/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        form {
            width: 100%;
            outline: 0;
            float: left;
            -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            -webkit-border-radius: 4px;
            border-radius: 4px;
        }

        form>.textbox {
            outline: 0;
            height: 42px;
            width: 90%;
            line-height: 42px;
            padding: 0 16px;
            background-color: rgba(255, 255, 255, 0.8);
            color: #212121;
            border: 0;
            float: left;
            -webkit-border-radius: 4px 0 0 4px;
            border-radius: 4px 0 0 4px;
        }

        form>.textbox:focus {
            outline: 0;
            background-color: #FFF;
        }

        form>.button {
            outline: 0;
            background: none;
            background-color: rgba(38, 50, 56, 0.8);
            float: left;
            height: 42px;
            width: 10%;
            text-align: center;
            line-height: 42px;
            border: 0;
            color: #FFF;
            font: normal normal normal 14px/1 FontAwesome;
            font-size: 16px;
            text-rendering: auto;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
            -webkit-transition: background-color .4s ease;
            transition: background-color .4s ease;
            -webkit-border-radius: 0 4px 4px 0;
            border-radius: 0 4px 4px 0;
        }

        form>.button:hover {
            background-color: rgba(0, 150, 136, 0.8);
        }

        .btn-circle.btn-xl {
            width: 70px;
            height: 70px;
            padding: 10px 16px;
            border-radius: 35px;
            font-size: 24px;
            line-height: 1.33;
        }
    </style>
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

                <?php

                if (isset($_SESSION["email"])) {

                ?>


                    <a href="../products/products.php" class="nav-item nav-link">Mis productos</a>

                <a href="../products/anadir.php" class="nav-item nav-link">Anadir productos</a>
                    <a href="../users/users.php" class="nav-item nav-link">Opciones de usuario</a>
                <?php

                }
                ?>
            </div>
            <div class="navbar-nav ml-auto">
                <?php
                if (isset($_SESSION["username"])) {
                ?>

                    <a href="../logout/logout.php" class="nav-item nav-link">Cerrar sesion ( <?php echo $_SESSION['username'] ?> )</a>
                <?php
                } else { ?>
                    <a href="../login/login.php" class="nav-item nav-link">Iniciar sesion</a>

                    <a href="../registrar/registrar.php" target="_blank" class="nav-item nav-link">registrar</a>

                <?php
                }
                ?>

            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <br>
        <div style="width:100%;text-align:center;display: flex;flex-direction: column;justify-content: top;align-items: center;display: flex;flex-direction: column;justify-content: top;align-items: center;" class="refresh">
            <!--<div style="background:#ccc;padding:1rem; width:6rem;">
        <strong><p>Refresh</p></strong>
        <i onclick="refresh()"class="fa fa-refresh fa-spin" style="font-size:24px"></i>
    </div>-->
            <form method="post" enctype="multipart/form-data">
                <input type="text" name="searchtext" class="textbox" placeholder="Buscar">
                <input title="Buscar" value="" type="submit" name="search" class="button">
            </form>
        </div>
        <br />
        <div class="FixedHeightContainer">
            <h5>Productos publicos</h5>
            <div class="Content">
                <section style="background:rgb(66, 65, 65); height:100%;">
                    <div class="table-responsive text-nowrap">
                        <!--Table-->
                        <table id="table1" class="table table-bordered table-dark table-hover">
                            <!--Table head-->
                            <thead>
                                <tr>

                                    <th>Nombre del producto</th>
                                    <th>Precio del producto</th>
                                    <th>Imagen Del Producto</th>
                                    <th>Informacion del vendedor</th>


                                </tr>
                            </thead>
                            <!--Table head-->
                            <!--Table body-->
                            <tbody>
                                <?php foreach ($products as $product) : ?>
                                    <tr>
                                        <!--<td style="text-align:center;"><button class="btn btn-danger btn-circle btn-xl" id="add" onclick="add();">+</button></td>-->

                                        <td id="name" style="width: 30%"><?php echo $product['productname'] ?></td>
                                        <td id="price" style="width: 20%"><?php echo $product['productprice'] ?></td>
                                        <td style="width: 20%"><img src="../serverimages/<?php echo $product['productimage'] ?>" style="width:30%;"></td>
                                        <td style="width: 20%">
                                            <div>Nombre:<?=$product["username"]?></div>
                                            <div>Email: <?=$product["email"]?></div>
                                            <div>Celular: <?=$product["celular"]?></div>
                                            <div>Whatsapp: <?=$product["whatsapp"]?></div>
                                            <div>Direccion: <?=$product["direccion"]?></div>
                                            <div>Ciudad: <?=$product["ciudad"]?></div>
                                        </td>


                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                            <!--Table body-->
                        </table>
                        <!--Table-->
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.slim.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>
    <!-- -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../publico/js/publico.js"></script>
    <script langauge="JavaScript">
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }

        function refresh() {
            window.location.reload();
        }
    </script>

</body>

</html>
