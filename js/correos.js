var asunto = "", html = "", tipo = "", tiquete = false,
    enlace = "",cedula = 123456789, apellidos="Rodriguez Vargas";
var nombres = ["Isabella", "Santiago"];
var raíz = window.location.href.match(/^.*\//);
$(document).ready(function(){
  actualizarTiquete();
  if($("input[name=Radio]").is(":checked")){
    var archivo = "correos/tipo"+$("input[name=Radio]:checked").val()+".html";
    $("#previsualizarCorreo").load(archivo, function () {
      actualizarTiquete();
      actualizarCorreo();
    });
  }
  

  $("input[name=Radio]").change(function(){
    switch($(this).val()){
      case "1":
        $("#previsualizarCorreo").load("correos/tipo1.html", function() {
          actualizarTiquete();
          actualizarCorreo();
        });
        break;
      case "2":
        $("#previsualizarCorreo").load("correos/tipo2.html", function() {
          actualizarTiquete();
          actualizarCorreo();
        });
        break;
      case "3":
        $("#previsualizarCorreo").load("correos/tipo3.html", function() {
          actualizarTiquete();
          actualizarCorreo();
        });
        break;
    }
  });

  $("input[name=asunto]").keyup(function(){
    actualizarCorreo();
  });

  $("textarea[name=html]").keyup(function(){
    actualizarCorreo();
  });

  $("select[name=listbox]").change(function(){
    //actualizarTiquete();
    actualizarCorreo();
  });

});

function actualizarCorreo(){
  $("#correo_pie a").attr("href",raíz);
  asunto = $("input[name=asunto]").val();
  html = "";
  var parrafos = $("textarea[name=html]").val().split("\n");
  for(var i = 0; i<parrafos.length; i++){
    html +="<p>"+parrafos[i]+"</p>";
  }
  //if($("select[name=listbox]").val() == "1"){
    html = html.replace("{[enlace]}",enlace);
//  }
  //if($("select[name=listbox]").val() == "4"){
    html = html.replace("{[nombre]}", nombres[Math.floor((Math.random() * 2))] + " " + apellidos);
    html = html.replace("{[fecha]}",Hoy());
  //}
  $("#correo_titulo").text(asunto);
  $("#correo_parrafos").html(html);
  if(tiquete){
    $("#correo_tiquete").show();
    $("#correo_tiquete_contenido").html("ADcmas1892-a");
  }else{
    $("#correo_tiquete").hide();
  }
}

function actualizarTiquete(){
  switch($("select[name=listbox]").val()){
    case "1":
      tiquete = true;
      enlace = "<a href=\""+raíz+"validar.php\" target=\"_blank\">Confirmar Registro</a>";
      break;
    case "2":
      tiquete = true;
    case "5":
      tiquete = true;
      break;
    default:
      tiquete = false;
      break;
  }
}

function Hoy(){
  var dia,mes,año;
  var hoy = new Date();
  if(hoy.getDate()<10){
    dia = "0"+hoy.getDate();
  } else{
    dia = hoy.getDate();
  }
  if((hoy.getMonth()+1)<10){
    mes = "0"+(hoy.getMonth()+1);
  } else{
    mes = hoy.getMonth()+1;
  }
  año = hoy.getFullYear();
  return dia+"/"+mes+"/"+año;
}

function azar(minimo, maximo) {
  return Math.floor(Math.random() * (maximo - minimo) ) + minimo;
}
/*
Bienvenido al sistema del departamento de psicología este mensaje es para confirmar su registro en nuestro sistema en caso de que no lo haya solicitado ignore este mensaje de lo contrario favor dirigirse a este enlace {[enlace]} e introduzca su cédula y el tiquete a continuación:*/
