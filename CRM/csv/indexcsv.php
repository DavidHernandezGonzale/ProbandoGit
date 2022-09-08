<?php
include 'conexion.php';


if (isset($_POST["enviar"])) { //isset nos permite recepcionar una variable que si exista y que no sea null

    require_once("conexion.php");
    require_once("funciones.php");

    $archivo = $_FILES["archivo"]["name"];
    $archivo_copiado = $_FILES["archivo"]["tmp_name"];
    $archivo_guardado = "copia_" . $archivo;
    $tipo_archivo = $_FILES['archivo']['type'];
    //echo $archivo . "esta en la ruta temporal: " . $archivo_copiado;

    if (copy($archivo_copiado, $archivo_guardado)) {

        echo "Se copió correctamente el archivo temporal a nuestra carpeta de trabajo<br>";
    } else {

        //echo "hubo un error";
    }

    $type = explode(".", $_FILES['archivo']['name']);

    if (strtolower(end($type)) == 'csv') { //Solo archivos en formato CSV , strtolower convierte a minúsculas y end() avanza el puntero interno del array hasta su último elemento y devuelve su valor.
        if (file_exists($archivo_guardado)) { //file_exists — Comprueba si existe un fichero o directorio
            $fp = fopen($archivo_guardado, "r"); //fopen — Abre un fichero o un URL y r abre el archivo sólo para lectura. La lectura comienza al inicio del archivo.
            $rows = 0; //Nos ayudará a imprimir desde la fila 1 y no la fila 0 donde vienen los titulos de las columnas
            echo "El archivo " . $archivo . " todos sus datos se cargaron con éxito<br>";
            while ($datos = fgetcsv($fp, 0, ",")) {
                $rows++;
                //echo $datos[0] ." ".$datos[1]." ".$datos[2]." ".$datos[3]." ".$datos[4]." ".$datos[5]." ".$datos[6]." ".$datos[7]." ".$datos[8]." ".$datos[9]." ".$datos[10]." ".$datos[11]." ".$datos[12]." ".$datos[13]." ".$datos[14]." ".$datos[15];
                if ($rows > 1) {

                    $resultado = insertar_datos($datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5], $datos[6], $datos[7], $datos[8], $datos[9], $datos[10], $datos[11], $datos[12], $datos[13], $datos[14], $datos[15]);
                    if ($resultado) {
                        //echo "Se inserto los datos correctamente<br/>";
                    } else {
                        //echo "no se inserto<br/>";
                    }
                }
            }
        } else {
            echo "no existe el archivo copiado";
        }
    } else {
        echo "Ocurrió el siguiente error en la carga: -issue error- solo se permiten archivos con formato .csv intentalo de nuevo.";
    }






    /*
    if(file_exists($archivo_guardado)){
        $fp= fopen($archivo_guardado,"r");
        $rows =0;
        echo "El archivo " . $archivo. " se ha subido con éxito";
        while($datos=fgetcsv($fp,0,",")){
            $rows ++;
            //echo $datos[0] ." ".$datos[1]." ".$datos[2]." ".$datos[3]." ".$datos[4]." ".$datos[5]." ".$datos[6]." ".$datos[7]." ".$datos[8]." ".$datos[9]." ".$datos[10]." ".$datos[11]." ".$datos[12]." ".$datos[13]." ".$datos[14]." ".$datos[15];
            if($rows > 1){

                $resultado= insertar_datos($datos[0],$datos[1],$datos[2],$datos[3],$datos[4],$datos[5],$datos[6],$datos[7],$datos[8],$datos[9],$datos[10],$datos[11],$datos[12],$datos[13],$datos[14],$datos[15]);
                if($resultado){
                //echo "Se inserto los datos correctamente<br/>";
                }else{
                //echo "no se inserto<br/>";
                }
            }
        }

    }else{
        echo "no existe el archivo copiado";
    }*/
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Subir archivo CSV</title>
    <style>
        table,
        th,
        td {
            border: 1.5px solid black;
            text-align: center;
        }
    </style>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>


    <div class="formulario">
        <form action="" class="formulariocompleto" method="post" enctype="multipart/form-data">
            <br>
            <input type="file" name="archivo" class="form-control" />
            <!--<input type="submit" value="SUBIR ARCHIVO CSV" class="form-control" name="enviar">-->
            <div class="d-grid gap-2 col-4 mx-auto">
                <br>
                <button type="submit" class="btn btn-danger" name="enviar">IMPORTAR PROSPECTOS</button>
            </div>
            <br>
            <center><a href="../views/listaClienteAgregados.php" class="btn btn-warning mr-4"> <i class="fas fa-undo-alt"></i>Regresar</a></center>

        </form>
    </div>

    <h1 class="text-primary">Prospectos de Facebook</h1>
    <table class="table">
        <thead class="table-dark">
            <th>ID del Prospecto</th>
            <th>Fecha de creación</th>
            <th>ID del anuncio</th>
            <th>Nombre del anuncio</th>
            <th>Conjunto de anuncios</th>
            <th>Nombre del conjunto de anuncios</th>
            <th>ID de la campaña</th>
            <th>Nombre de la campaña</th>
            <th>ID del formulario</th>
            <th>Nombre del formulario</th>
            <th>¿Fue orgánico?</th>
            <th>Plataforma</th>
            <th>Nombre completo</th>
            <th>Número de teléfono</th>
            <th>Ciudad</th>
            <th>Estado</th>
        </thead>
        <?php $mostrar = $conexión->query("SELECT * FROM prospectos_informacion");
        while ($fila = $mostrar->fetch_assoc()) { //El fetch_assoc nos permitirá recorrer las filas y las columnas.
        ?>
            <tr>

                <td><?php echo $fila['id'] ?></td>
                <td><?php echo $fila['created_time'] ?></td>
                <td><?php echo $fila['ad_id'] ?></td>
                <td><?php echo $fila['ad_name'] ?></td>
                <td><?php echo $fila['adset_id'] ?></td>
                <td><?php echo $fila['adset_name'] ?></td>
                <td><?php echo $fila['campaign_id'] ?></td>
                <td><?php echo $fila['campaign_name'] ?></td>
                <td><?php echo $fila['form_id'] ?></td>
                <td><?php echo $fila['form_name'] ?></td>
                <td><?php echo $fila['is_organic'] ?></td>
                <td><?php echo $fila['platform'] ?></td>
                <td><?php echo $fila['nombre_completo'] ?></td>
                <td><?php echo $fila['número_de_teléfono'] ?></td>
                <td><?php echo $fila['ciudad'] ?></td>
                <td><?php echo $fila['estado'] ?></td>
            </tr>
        <?php } ?>
    </table>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>