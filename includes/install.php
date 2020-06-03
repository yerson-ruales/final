<?php 
    if(isset($_POST["host"])){
        //Escribir en el archivo config las variables de conexión
        $file = fopen("../connection/connection.php", "w");

        fwrite($file, "<?php" . PHP_EOL);
        fwrite($file, "session_start();" . PHP_EOL);
        fwrite($file, "define('HOST', '" . $_POST['host'] ."');" . PHP_EOL);
        fwrite($file, "define('USER', '" . $_POST['user'] ."');" . PHP_EOL);
        fwrite($file, "define('PASSWORD', '" . $_POST['password'] ."');" . PHP_EOL);
        fwrite($file, "define('DB', '" . $_POST['db'] ."');" . PHP_EOL);
        fwrite($file, "\$con=mysqli_connect(HOST,USER,PASSWORD,DB) or die(mysqli_connect_error());	" . PHP_EOL);
        fwrite($file, "?>");

        fclose($file);
        
        echo "Creando archivo de conexión";

        //Importando la base de datos
        $sql = file_get_contents('db.sql');

        include('db.php');

        if(DB::getConnection()->multi_query($sql)){
           echo "Se ejecuto la importación correctamente////////////////////";
           unlink('install.php');
           header('Location: ../');
        }else{
            echo "No se ha podido importar la base de datos, verifique los errores";
        }
        
        die;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base_Datos</title>
    <link rel="stylesheet" href="css/styles_bd.css">
</head>
<body>
    <h1>Database Connection</h1> 
    <form action="install.php" method="post">
    <div class="box">
    <div>
            <label for="host">Host</label>
            <input type="text" name="host" >
        </div>

        <div>
            <label for="user">User</label>
            <input type="text" name="user" >
        </div>

        <div>
            <label for="password">Password</label>
            <input type="text" name="password">
        </div>

        <div>
            <label for="db">Database </label>
            <input type="text" name="db">
        </div>

        <button class="boton">Save</button>
    </div>
       
    </form>
</body>
</html>
