<?php
    /* INICIO - Tratamiento de los input type='text' */
    $nom_usu = empty($_POST['nom_usu']) ? '' : $_POST['nom_usu'];
    $con_usu = empty($_POST['con_usu']) ? '' : $_POST['con_usu'];

    $con_usu_encr = password_hash($con_usu, PASSWORD_DEFAULT);
    /* FIN - Tratamiento de los input type='text' */

    // Llamada a la conexion
    require_once "../Db/Con1Db.php";
    // Llamada al modelo
    require_once "../Models/Datos1Model.php";

    // Instanciacion del objeto
    $oData = new Datos;


    if(!isset($nom_usu) || !isset($_POST["con_usu"])){
        echo "No hay datos";
    }
    else{

        $sql="SELECT * FROM usuarios WHERE nom_usu = ? ;";
        $resultado = $oData->getDataPS1($sql,$nom_usu,1);
        if (!$resultado){
/* ------------------------Falla aquí--------------------------- */
            //die("no hay resultado de la consulta".mysqli_error());
        }
        else{
            //echo "todo bien";
            $fila = mysqli_fetch_array($resultado,MYSQLI_BOTH);
            if($fila){
            echo "Lo sentimos, el usuario ya existe";
            }
            else{
                //echo "insertamos el usuario";
                $sql_insertar="INSERT INTO usuarios (nom_usu, con_usu) VALUES (?, ?);";
    
                $resultado_insertar = $oData->registrarUsuario1($sql_insertar, $nom_usu, $con_usu_encr);
                if (!$resultado_insertar){
                    die("no hay resultado de la copnsulta".mysqli_error($conexion));
                }
                else{
                    echo "Usuario registrado con éxito";
                }
    
            }
        }
    }







?>