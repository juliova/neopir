$(document).ready(function(){

  $("#estudiantes tr").click(function(){
    window.location.href = "graficogeneral.html";
  });

  /*Colorea el icono de menu y muestra el menu responsivo cuando el
      icono es presionado.*/
  $("menu i").click(function(){
    $(this).toggleClass("menuResponsivo");
    $("menu ul").toggleClass("mostrar");
  });

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
  });
});
