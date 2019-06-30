$(document).ready(function(){

  $(".color1").click(function(){
    copiar("#f3f9fb");
  });

  $(".color2").click(function(){
    copiar("#87c0cd");
  });

  $(".color3").click(function(){
    copiar("#226597");
  });

  $(".color4").click(function(){
    copiar("#113f67");
  });

  $(".color5").click(function(){
    copiar("#c2c9cf");
  });

});

function copiar(texto){
  $("input[name=texto]").val(texto);
  $("input[name=texto]").select();
  document.execCommand('copy');
}
