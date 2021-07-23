<?php
session_start();
$accion = $_REQUEST['accion'];

switch ($accion) {
    case  'InsertaUsuario':

        include('conexion.php');

        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $especialidad = $_POST['especialidad'];
        $tipo = $_POST['tipo'];
        $dni = $_POST['dni'];
        $estado = $_POST['estado'];
        $foto = $_FILES['foto']['tmp_name'];

        $revisar = getimagesize($_FILES["foto"]["tmp_name"]);
        // if ($foto == '') {
        //     echo 'no hay imagen';
        // } else {
        //     echo 'si hay imagen';
        // }

        if ($revisar) {
            $imgContenido = addslashes(file_get_contents($foto));
            $insertar = $cn->query("INSERT INTO `adminuser` (`id`, `nombres`, `apellidos`, `usuario`, 
            `clave`, `especialidad`, `foto`, `tipo`, `estado`, `modificado`, `dni`)
             VALUES (NULL,'$nombres','$apellidos','$usuario','$clave','$especialidad','$imgContenido','$tipo','$estado','','$dni')");

            if ($insertar) {
                header('Location: ../admin.php?nt=1');
                // echo 1;
            } else {
                // header('Location:admin.php?nt=4');
                echo mysqli_error($cn);
            }
        } else {
            header('Location:admin.php?nt=6');
        }

        break;

    case  'EliminarUsuario':
        include('conexion.php');

        $id = $_POST['id'];

        $insertar = $cn->query("DELETE FROM `adminuser` WHERE `adminuser`.`id` = '$id'");
        if ($insertar) {
            header('Location:../admin.php?nt=2');
        } else {
            echo mysqli_error($cn);
        }
        break;
    case  'ActualizarUsuario':

        include('conexion.php');

        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $especialidad = $_POST['especialidad'];
        $tipo = $_POST['tipo'];
        $dni = $_POST['dni'];
        $estado = $_POST['estado'];
        $foto = $_FILES['foto']['tmp_name'];
        $id = $_POST['id'];
        $muser = $_POST['muser'];

        if ($foto == '') {
            $insertar = $cn->query("UPDATE `adminuser` SET `nombres` = '$nombres', `apellidos` = '$apellidos', 
            `usuario` = '$usuario', `clave` = '$clave', `especialidad` = '$especialidad', `tipo` = '$tipo',  `dni` = '$dni', `estado` = '$estado' WHERE `adminuser`.`id` = '$id';");

            if ($insertar) {
                $modificado = $cn->query("UPDATE `adminuser` SET `modificado` = '$muser' WHERE `adminuser`.`id` = '$id';");
                if ($modificado) {
                    header('Location: ../Edit-user.php?id=' . $id . '&nt=3');
                } else {
                    header('Location: ../Edit-user.php?id=' . $id . '&nt=3');
                }
                // echo 1;
            } else {
                // header('Location:admin.php?nt=4');
                echo mysqli_error($cn);
            }
        } else {
            $revisar = getimagesize($_FILES["foto"]["tmp_name"]);

            if ($revisar) {
                $imgContenido = addslashes(file_get_contents($foto));
                $insertar = $cn->query("UPDATE `adminuser` SET `foto` = '$imgContenido',`nombres` = '$nombres', `apellidos` = '$apellidos', 
                `usuario` = '$usuario', `clave` = '$clave', `especialidad` = '$especialidad', `tipo` = '$tipo',  `dni` = '$dni', `estado` = '$estado' WHERE `adminuser`.`id` = '$id';");

                if ($insertar) {
                    $modificado = $cn->query("UPDATE `adminuser` SET `modificado` = '$muser' WHERE `adminuser`.`id` = '$id';");
                    if ($modificado) {
                        header('Location: ../Edit-user.php?id=' . $id . '&nt=3');
                    } else {
                        header('Location: ../Edit-user.php?id=' . $id . '&nt=3');
                    }
                } else {
                    // header('Location:admin.php?nt=4');
                    echo mysqli_error($cn);
                }
            } else {
                header('Location: ../Edit-user.php?id=' . $id . '&nt=6');
            }
        }



        break;
    case  'RegistrarCurso':

        require_once('conexion.php');

        $categoria = $_POST['categoria'];
        $tipo = $_POST['tipo'];
        $cantidad = $_POST['cantidad'];
        $tiempo = $_POST['tiempo'];
        $fecha = $_POST['fecha'];
        $id_pro = $_POST['id_pro'];
        $id_mes = $_POST['id_mes'];

        $respuesta = $cn->query("INSERT INTO `curso` (`id_curso`, `categoria`, 
            `tipo`,  `cantidad`, `tiempo`, `fecha`,`id_pro`, `id_mes`) 
             VALUES (NULL, '$categoria', '$tipo', '$cantidad', '$tiempo', 
             '$fecha',  '$id_pro', '$id_mes');");

        if (!$accion) {
            echo $cn->error;
        } else {
            header('location:../cursos.php?id_pro=' . $id_pro . '&id_mes=' . $id_mes . '&nt=1');
        }

        break;
}
