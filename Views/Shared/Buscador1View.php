<?php
    // Llamada a la conexion
    require_once "./Db/Con1Db.php";
    // Llamada al modelo
    require_once "./Models/Datos1Model.php";

    // Instanciacion del objeto
    $oData = new Datos;
    // Llamada al metodo
    $oData->controlAcceso1();
?>


<div id="contenedor0" class="contenedor0">
    <div id="contenedor1" class="contenedor1">
        <form id="formConsulta1" class="form1">
            <input type="text" id="textoConsulta1" name="textoConsulta1" required class="campo2 center">
            <input type="submit" id="botonConsulta1" name="botonConsulta1" value="Buscar" class="boton1">
            <input type="button" id="botonConsulta2" name="botonConsulta2" value="Ver todo" class="boton1">
        </form>
    </div>
    <div id="contenedor2" class="contenedor2">  
    </div>
</div>

