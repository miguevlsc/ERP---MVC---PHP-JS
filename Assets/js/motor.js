function deshabilitarControl1(control1)
{
    control1.classList.remove("boton1");
    control1.classList.add("boton1Inhabilitado1");
    control1.disable = true;
}

function habilitarControl1(control1)
{
    control1.classList.remove("boton1Inhabilitado1");
    control1.classList.add("boton1");
    control1.disable = false;
}

/* INICIO - ajaxPost1 - Devuelve el resultado a un DIV (POST) */
function ajaxPost1Sesion(form1, controlador1, div1)
{
  const Ajax1 = new XMLHttpRequest();
  const FormData1 = new FormData( form1 );
  
  Ajax1.addEventListener("load", function(event) {

    let respuesta1 = this.responseText;
    console.log("respuesta server " + {respuesta1});

    if(respuesta1 == 1){window.location.assign("inicio.php");}

    else if(respuesta1 == 0){div1.innerHTML = "Usuario o clave incorrecta";}

    else{div1.innerHTML = "No se ha podido realizar la autenticación";}
  });
  
  Ajax1.addEventListener("error", function( event ) {
    alert( 'Error: no se ha enviado la informacion' );
  } );
  Ajax1.open("POST", controlador1);
  Ajax1.send( FormData1 );
}
/* FIN - ajaxPost1 - Devuelve el resultado a un DIV (POST) */

/* INICIO - ajaxPost1 - Devuelve el resultado a un DIV (POST) */
function ajaxPost1Registro(form1, controlador1, div1)
{
  const Ajax1 = new XMLHttpRequest();
  const FormData1 = new FormData( form1 );

  console.log("aaa");
  
  Ajax1.addEventListener("load", function(event) {

    let respuesta1 = this.responseText;
    console.log("respuesta server " + {respuesta1});

    //if(respuesta1 == 1){window.location.assign("inicio.php");}

    //else if(respuesta1 == 0){div1.innerHTML = "Usuario o clave incorrecta";}

    div1.innerHTML = respuesta1;
  });
  
  Ajax1.addEventListener("error", function( event ) {
    alert( 'Error: no se ha enviado la informacion' );
  } );
  Ajax1.open("POST", controlador1);
  Ajax1.send( FormData1 );
}
/* FIN - ajaxPost1 - Devuelve el resultado a un DIV (POST) */


/* INICIO - ajaxPost1 - Devuelve el resultado a un DIV (POST) */
function ajaxPost1(form1, controlador1, div1)
{
  const Ajax1 = new XMLHttpRequest();
  const FormData1 = new FormData( form1 );
  
  Ajax1.addEventListener("load", function(event) {
    //console.log(this.responseText);
    document.getElementById(div1.id).innerHTML = this.responseText;
  });
  
  Ajax1.addEventListener("error", function( event ) {
    alert( 'Error: no se ha enviado la informacion' );
  } );
  
  Ajax1.open("POST", controlador1);
  Ajax1.send( FormData1 );
}
/* FIN - ajaxPost1 - Devuelve el resultado a un DIV (POST) */


/* INICIO - ajaxPost1 - Devuelve el resultado a un DIV (POST) */
function ajaxPost2(controlador1, div1)
{
  const Ajax1 = new XMLHttpRequest();
  
  Ajax1.addEventListener("load", function(event) {
    //console.log(this.responseText);
    document.getElementById(div1.id).innerHTML = this.responseText;
  });
  
  Ajax1.addEventListener("error", function( event ) {
    alert( 'Error: no se ha enviado la informacion' );
  } );
  
  Ajax1.open("POST", controlador1);
  Ajax1.send();
}
/* FIN - ajaxPost1 - Devuelve el resultado a un DIV (POST) */


/* INICIO - ajaxGet1 - Devuelve el resultado a un DIV (GET) */
function ajaxGet1(controlador1, div1) {
  
  let ajax1 = new XMLHttpRequest();
  ajax1.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200)
    {
      document.getElementById(div1.id).innerHTML = this.responseText;
    }
  };
  ajax1.open("GET", controlador1, true);
  ajax1.send();
  
}
/* FIN - ajaxGet1 - Devuelve el resultado a un DIV (GET) */


// ------ INICIO GRAFICOS ---------
/* INICIO - ajaxGet1 - Devuelve el resultado a un DIV (GET) */
function ajaxGetGraficos1(controlador1) {
  
  let ajax1 = new XMLHttpRequest();
  ajax1.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200)
    {
      let respuesta = this.responseText;
      graficos(respuesta);
    }
  };
  ajax1.open("GET", controlador1, true);
  ajax1.send();
  
}
/* FIN - ajaxGet1 - Devuelve el resultado a un DIV (GET) */

function graficos(data1){
  //console.log(data1);
  var ctx = document.getElementById("g1").getContext("2d");
  var g1 = new Chart(ctx, {
    type: "radar",
    data: {
      labels: ['Número de Clientes', 'PVP vendido', 'Número de ventas'],
      datasets: [{
        label: 'Num Datos',
        data: data1
      }]
    }
    
  });
}
function graficos2(data1){
  //console.log(data1);
  var ctx = document.getElementById("g2").getContext("2d");
  var g1 = new Chart(ctx, {
    type: "radar",
    data: {
      labels: ['Número de Clientes', 'PVP vendido', 'Número de ventas'],
      datasets: [{
        label: 'Num Datos',
        data: data1
      }]
    }
    
  });
}

// ------ FIN GRAFICOS ---------



function seleccionarDatos1Sesion(form1, boton1, controlador1, div1)
{    
    deshabilitarControl1(boton1);
    ajaxPost1Sesion(form1,controlador1, div1);
    habilitarControl1(boton1);
    form1.reset();
}
function seleccionarDatos1Registro(form1, boton1, controlador1, div1)
{    
    deshabilitarControl1(boton1);
    ajaxPost1Registro(form1,controlador1, div1);
    habilitarControl1(boton1);
    form1.reset();
}

function seleccionarDatos1(form1, boton1, controlador1, div1)
{    
    deshabilitarControl1(boton1);
    ajaxPost1(form1,controlador1,div1);
    habilitarControl1(boton1);
    form1.reset();
}

function seleccionarDatos2(form1, boton1, controlador1, div1)
{
  deshabilitarControl1(boton1);
  ajaxGet1(controlador1, div1);
  habilitarControl1(boton1);
  form1.reset();
}

function modificarDatos1(form1, boton1, controlador1, div1)
{      
  deshabilitarControl1(boton1);
  // Opcion 1: El mensaje se muestra en un div (ajaxPost1)
  ajaxPost1(form1,controlador1,div1);
  // Opcion 2: El mensaje se muestra en una alert (ajaxPost2)
  // ajaxPost2(form1,controlador1,div1);
  habilitarControl1(boton1);
  // Para que no se pierdan los datos reflejados tras la modificación
}


window.addEventListener('load', function(){

  let boton1;
  let boton2;
  let controlador1;
  let controlador2;
  let div1;
  let div2;


  /* ------------Factura Proveedor ---------------- INICIO */
  let btnNuevo = this.document.getElementById("nuevo");
  let btnExistente = this.document.getElementById("existente");
  let contenedor3 = this.document.getElementById("contenedor3");
  if(btnNuevo)
  {
    btnNuevo.addEventListener("click", function(event)
    {
      event.preventDefault;
      let controlador = "Views/Proveedores/CrearFactura2View.php";
      ajaxPost2(controlador,contenedor3);

    })
  }
  if(btnExistente)
  {
    btnExistente.addEventListener("click", function(event)
    {
      event.preventDefault;
      let controlador = "Views/Proveedores/CrearFactura3View.php";
      ajaxPost2(controlador,contenedor3);

    })
  }
  /* ------------Factura Proveedor ---------------- FIN */

  /* ---------------SESION ------------------- INICIO - (submit SESION) Seleccionar 1 */
  const formSesion1 = document.getElementById("formSesion1");
  
  if(formSesion1)
  {
    boton1 = document.getElementById("b1");
    div1 = document.getElementById("contenedor2");
    controlador1 = "Controllers/Index1Controller.php";

    formSesion1.addEventListener("submit", function(event){
      event.preventDefault();
      seleccionarDatos1Sesion(formSesion1,boton1,controlador1,div1);
    });
  }
  /* -----------------SESION----------------- FIN - (submit) Seleccionar 1 */
  
  /* ---------------REGISTRO ------------------- INICIO - (submit SESION) Seleccionar 1 */
  const formRegistro1 = document.getElementById("formRegistro1");
  
  if(formRegistro1)
  {
    boton1 = document.getElementById("b1");
    div1 = document.getElementById("contenedor2");
    controlador1 = "Controllers/Registro1Controller.php";

    formRegistro1.addEventListener("submit", function(event){
      event.preventDefault();
      seleccionarDatos1Registro(formRegistro1,boton1,controlador1,div1);
    });
  }
  /* -----------------REGISTRO----------------- FIN - (submit) Seleccionar 1 */

  /* ---------------------------------- INICIO - (submit) Seleccionar 1 */
  const formConsulta1 = document.getElementById("formConsulta1");
  if(formConsulta1)
  {
    boton1 = document.getElementById("botonConsulta1");
    let controlador1 = this.document.getElementById("controlador1").value;
    div1 = document.getElementById("contenedor2");

    formConsulta1.addEventListener("submit", function(event){
      event.preventDefault();
      seleccionarDatos1(formConsulta1,boton1,controlador1,div1);
    });
  }
  /* ---------------------------------- FIN - (submit) Seleccionar 1 */

  /* ---------------------------------- INICIO - (click) Seleccionar 2 */
  const botonConsulta2 = document.getElementById("botonConsulta2");

  if(botonConsulta2)
  {
    let controlador2 = this.document.getElementById("controlador1").value;
    console.log(controlador2);
    div2 = document.getElementById("contenedor2");

    botonConsulta2.addEventListener("click", function(event){
      event.preventDefault();
      seleccionarDatos2(formConsulta1,botonConsulta2,controlador2,div2);
    });
  }
  /* ---------------------------------- FIN - (click) Seleccionar 2 */

    /* ---------------------------------- INICIO - (submit) Modificar 1 */
  // Paso 1: Obtener referencias:
  const formModificacion1 = document.getElementById("formModificacion1");
  // Paso 2 - Asociación del elemento al evento (submit) y llamada a la función
  if(formModificacion1)
  {
    // Referencia de los elementos
    boton1 = document.getElementById("botonModificacion1");
    let controlador1 = this.document.getElementById("controlador1").value;
    div1 = document.getElementById("contenedor2");
    // Evento y llamada a la función
    formModificacion1.addEventListener("submit", function(event){
      event.preventDefault();
      console.log(formModificacion1);
      modificarDatos1(formModificacion1,boton1,controlador1,div1);
    });
  }
  /* ---------------------------------- FIN - (submit) Modificar 1 */

  /* ---------------------------------- INICIO - (submit) Insertar 3 */
  // Paso 1: Obtener referencias:
  const formInsercion3 = document.getElementById("formInsercion3");
  // Paso 2 - Asociación del elemento al evento (submit) y llamada a la función
  if(formInsercion3)
  {
    // Referencia de los elementos
    boton1 = document.getElementById("botonInsercion3");
    let controlador2 = this.document.getElementById("controlador1").value;
    div1 = document.getElementById("contenedor2");
    // Evento y llamada a la función
    formInsercion3.addEventListener("submit", function(event){
      event.preventDefault();
      seleccionarDatos1(formInsercion3,boton1,controlador2,div1);
    });
  }
  /* ---------------------------------- FIN - (submit) Insertar 3 */

  //Navegador
  //Ejecutar evento click
  const btn_open = document.getElementById("btn_open");
  if(btn_open){
    //Declara variables
    var menu_side = document.getElementById("menu_side");
    let body = document.getElementsByTagName("body");
    body.id = "body";
    body = document.getElementById("body");

    btn_open.addEventListener("click", open_close_menu);

    //Evento para mostrar ocultar menu
    function open_close_menu() {
        body.classList.toggle("body_move");
        menu_side.classList.toggle("menu_side_move");
    }
    //NavegadorFin

  }
  //grafica
  let graficas = this.document.getElementById("graficas");
  if(graficas)
  {
    graficas.addEventListener("load",ajaxGetGraficos1("./Controllers/Inicio1Controller.php"));
  }

  // Add active class to the current button (highlight it)
  var header = document.getElementById("opciones_menu");
  var btns = header.getElementsByClassName("btn");
  for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("selected");
    current[0].classList.remove("selected");
    this.className += " selected";
    });
  }
    
    
  //grafica fin
});


