<div id="contenedor0" class="contenedor0">
    <div id="contenedor1" class="contenedor1">
        <form id="formModificacion1" class="form1">
            <?php require_once "Controllers/ProductoEditar1Controller.php"; ?>
            <input type="hidden" id="controlador1" name="controlador1" value ="Controllers/ProductoModificacion1Controller.php">
            <input type="hidden" id="textoModificacion0" name="textoModificacion0" value ="<?php echo $id_producto?>">
            <input type="text" id="textoModificacion1" name="textoModificacion1" required class="campo2" value ="<?php echo $nomArt?>" placeholder="Artículo">
            <input type="number" id="textoModificacion2" name="textoModificacion2" required class="campo2" value ="<?php echo $pvpArt?>" placeholder="PVP">
            <input type="submit" id="botonModificacion1" name="botonModificacion1" value="Modificar" class="boton1">
        </form>
    </div>
    <div id="contenedor2" class="contenedor2">
    </div>
</div>