$(document).ready(function(){

  /*Colorea el icono de menu y muestra el menu responsivo cuando el
      icono es presionado.*/
  $("menu i").click(function(){
    $(this).toggleClass("menuResponsivo");
    $("menu ul").toggleClass("mostrar");
  });

  $("input[name=contraC]").keyup(function(){
    verificarC();
  });

  $("input[name=contra2]").keyup(function(){
    verificarC();
  });
 /*
  //Inicia el calendario
  $("#selectorFechas").datepicker({
    //Escoje la localización en español
    language: 'es',
    //Evita que escoja una fecha o hora menor a la actual
    minDate: new Date(),
    //Escribe la fecha y hora seleccionada cada vez que uno de estos es
    //modificada,
    onSelect: function(fechaF,fecha,selector) {
      //d=dia, m=mes, y=año, h=hora, ii=minutos, AA= AM/PM
      //La fecha es recibida en el formato 'dd/mm/yyyy hh:ii AA'
      //Los datos son escritos en el campo de fecha
      $("input[name='fecha']").val(fechaF);
    }
  }); */
});

function verificarC(){
  if ($("input[name=contraC]").val() === $("input[name=contra2]").val()) {
    $("#registro").attr('disabled', false);
    $("input[name=contraC]").css("border-color", "#113f67");
  } else {
    $("#registro").attr('disabled', true);
    $("input[name=contraC]").css("border-color", "red");
  }
}