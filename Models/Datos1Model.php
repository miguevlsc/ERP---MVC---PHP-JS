<?php 

    class Datos
    {

        private $mysqli;
        private $data;

        public function __construct()
        {
            $this->mysqli=Connection::conn1();
            $this->data=array();
            //$mysqli->set_charset("utf8");
        }


        public function liberarVariables1()
        {
            // Iniciar una sesión o reanudar la existente
            session_start();

            // Liberar todas las variables de sesión
            session_unset();

            // Destruir la información registrada en una sesión (pero no las variables de sesión)
            session_destroy();

            // Desecha los cambios en el array de sesión y finaliza la sesión
            // session_abort();
        }

        public function controlAcceso1()
        {
            // Iniciar una nueva sesión o reanudar la existente
            //session_write_close();
            session_start();

            // Comprobar que el usuario está autenticado
            if(!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != true || empty($_SESSION['autenticado']))
            {
                // Si el usuario no está autenticado lo redirigimos a index.php
                header('Location: index.php');

            }


        }

        // Control de permisos de usuario (1 = admin (RWD), 2 = user++(RW), 3 = user(R))
        public function nivelUsuario($nivel, $pagina){

            if($nivel != 1){

                $nivel == 2 ?  header('Location: inicio2.php') : header('Location: index.php');
                //header('Location: inicio2.php');
            }
            else{
                header('Location: inicio1.php');
            }

            
        }

        

        // Devuelve datos de la BD (select) con Prepared Statement
        public function sesion1($sql, $par1, $par2)
        {
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param("ss", $par1, $par2); // ssi = string, string, integer
            
            if(!$stmt->execute())
            {
                $nivel = 0;
                $result = "La operacion no se ha podido realizar.";
                // echo "Detalle del error en la consulta (setData1) - ";
                // echo "Numero del error: " . $this->mysqli->errno . " - ";
                // echo "Descripcion del error: " . $this->mysqli->error;
            }
            else
            {
                
                $respuesta = $stmt->get_result();
                $numRegistros = $respuesta->num_rows;
                
                if($numRegistros){
                    session_start();
                    $_SESSION['autenticado'] = true;
                    while ( $fila = $respuesta->fetch_assoc())
                    {
                        $_SESSION['ide_usu'] = $fila['id_usu'];
                        $_SESSION['nom_usu'] = $fila['nom_usu'];
                        $_SESSION['niv_usu'] = $fila['niv_usu'];
                        
                    }

                    // Devuelve 1 a autenticar1 en motor.js (Acceso aceptado)
                    $respuesta = $_SESSION['niv_usu'];
                }
                else{$respuesta = 0;}


                return $respuesta;
                    
            }
        }


        // Devuelve datos de la BD (select) con Prepared Statement
        public function getDataPS1($sql, $par1, $numPar) // $numPar = número de parámetros que requiere la consulta
        {
            $stmt = $this->mysqli->prepare($sql);

            if($numPar === 1){$stmt->bind_param("s", $par1);} // s = string
            else if($numPar === 2){$stmt->bind_param("ss", $par1, $par1);} // s = string
            else if($numPar === 3){$stmt->bind_param("sss", $par1, $par1, $par1);} // s = string
            else if($numPar === 4){$stmt->bind_param("ssss", $par1, $par1, $par1, $par1);} // s = string
            else if($numPar === 5){$stmt->bind_param("sssss", $par1, $par1, $par1, $par1, $par1);} // s = string
            else if($numPar === 6){$stmt->bind_param("ssssss", $par1, $par1, $par1, $par1, $par1, $par1);} // s = string
            
            if(!$stmt->execute())
            {
                $nivel = 0;
                $result = "La operacion no se ha podido realizar.";
                echo "Detalle del error en la consulta (setData1) - ";
                echo "Numero del error: " . $this->mysqli->errno . " - ";
                echo "Descripcion del error: " . $this->mysqli->error;
            }
            else
            {
                
                $respuesta = $stmt->get_result();
                $numRegistros = $respuesta->num_rows;
                if($numRegistros){
                    //session_start();
                    while($rows=$respuesta->fetch_object())
                    {
                        $this->data[]=$rows;
                    }
                }
                
            }
            $this->mysqli->close();
            //error_log(.$_SESSION['nivel']);
            return $this->data;
        }


        public function getData1($sql)
        {
            if (!$this->mysqli->query($sql))
            {
                echo "La operacion no se ha podido realizar.";
                echo "Detalle del error en la consulta (getData1) - ";
                echo "Numero del error: " . $this->mysqli->errno . " - ";
                echo "Descripcion del error: " . $this->mysqli->error;
            }
            else
            {
                $result=$this->mysqli->query($sql);
                while($rows=$result->fetch_object())
                {
                    $this->data[]=$rows;
                }
                $result->close();
            }
            $this->mysqli->close();
            return $this->data;
        }

        // No devuelve datos de la BD (insert, update, delete)
        public function setData1($sql)
        {
            if(!$this->mysqli->query($sql))
            {
                $result = "La operacion no se ha podido realizar.";
                 echo "Detalle del error en la consulta (setData1) - ";
                 echo "Numero del error: " . $this->mysqli->errno . " - ";
                 echo "Descripcion del error: " . $this->mysqli->error;
            }
            else
            {
                $result = "Operacion realizada con exito";
            }
            $this->mysqli->close();
            return $result;
        }

        // No devuelve datos de la BD (insert, update, delete con consultas preparadas)
        public function setDataPreparedStatements1($sql, $par1, $par2, $par3, $par4, $par5)
        {
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param("siisi", $par1, $par2, $par3, $par4, $par5); // ssi = string, string, integer
            
            if(!$stmt->execute())
            {
                $result = "La operacion no se ha podido realizar.";
                // echo "Detalle del error en la consulta (setData1) - ";
                // echo "Numero del error: " . $this->mysqli->errno . " - ";
                // echo "Descripcion del error: " . $this->mysqli->error;
            }
            else
            {
                $result = "Operacion realizada con exito";
            }
            $this->mysqli->close();
            return $result;
        }
        public function setDataPreparedStatements2($sql, $par1, $par2, $par3)
        {
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param("sis", $par1, $par2, $par3); // ssi = string, string, integer
            
            if(!$stmt->execute())
            {
                $result = "La operacion no se ha podido realizar.";
                // echo "Detalle del error en la consulta (setData1) - ";
                // echo "Numero del error: " . $this->mysqli->errno . " - ";
                // echo "Descripcion del error: " . $this->mysqli->error;
            }
            else
            {
                $result = "Operacion realizada con exito";
            }
            $this->mysqli->close();
            return $result;
        }


        // No devuelve datos de la BD (insert, update, delete con consultas preparadas)
        public function registrarUsuario1($sql, $par1, $par2)
        {
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param("ss", $par1, $par2); // ssi = string, string, integer
            
            if(!$stmt->execute())
            {
                $result = "La operacion no se ha podido realizar.";
                // echo "Detalle del error en la consulta (setData1) - ";
                // echo "Numero del error: " . $this->mysqli->errno . " - ";
                // echo "Descripcion del error: " . $this->mysqli->error;
            }
            else
            {
                $result = "Operacion realizada con exito";
            }
            $this->mysqli->close();
            return $result;
        }
    }



?>