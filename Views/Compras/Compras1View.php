<section class="contenedor0">
    <div class="contenedor1 flex">
        <h1 class="center">CONSULTAR COMPRAS CLIENTES</h1>
        <div id="contenedor0" class="contenedor0 center">
            <input type="hidden" name="controlador" id="controlador1" value="Controllers/Compras1Controller.php">
            <div id="contenedor1" class="contenedor1">
                <form id="formConsulta1" class="form1">
                    <input type="text" id="textoConsulta1" name="textoConsulta1" required class="campo2 center">
                    <input type="submit" id="botonConsulta1" name="botonConsulta1" value="Buscar" class="boton1">
                    <input type="button" id="botonConsulta2" name="botonCompras2" value="Ver todo" class="boton1">
                </form>
            </div>
        </div>
    </div>
    <div id="contenedor2" class="contenedor2">  
        <?php require_once "Controllers/Compras1Controller.php"; ?>
    </div>

</section>

