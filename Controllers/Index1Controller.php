<?php
    /* INICIO - Tratamiento de los input type='text' */
    $nom_usu = empty($_POST['nom_usu']) ? '' : $_POST['nom_usu'];
    $con_usu = empty($_POST['con_usu']) ? '' : $_POST['con_usu'];
    /* FIN - Tratamiento de los input type='text' */

    // Llamada a la conexion
    require_once "../Db/Con1Db.php";
    // Llamada al modelo
    require_once "../Models/Datos1Model.php";

    // Instanciacion del objeto
    $oData = new Datos;

    // Liberar variables de sesión
    $oData->liberarVariables1();

    $resultado = 0;


    $sql = "SELECT * FROM usuarios WHERE nom_usu = ? AND con_usu = ?;";

    $resultado = $oData->sesion1($sql, $nom_usu, $con_usu);

    /*if($resultado)
        {
            // Devuelve 1 a autenticar1 en motor.js (Acceso aceptado)
            header('Location: ../inicio.php');
        }

        else
        {
            echo "Usuario o clave incorrecta";
        }

    */
    // Liberar el conjunto de resultados
    
    echo $resultado;
    //$resultado->free();

?>