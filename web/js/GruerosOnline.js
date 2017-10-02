$(document).ready(function(){
    consultaGruerosOnline();

    setInterval(function() {
         consultaGruerosOnline();
    }, 60000);
});
function consultaGruerosOnline(){
  var jqxhr = $.get( link_servidor + "/servicios/adminapp/gruerosOnline.php", function(datos) {
  })
  .done(function(datos) {
      //console.log(datos);
    $.each(datos.data, function(i, item) {
      console.log(item.offline);
      console.log(item.online);
      $("#offline.GruerosOnline").html(item.offline);
      $("#online.GruerosOnline").html(item.online);
      $("#onservice.GruerosOnline").html(item.onservice);
    });
  })
  .fail(function() {
    console.log( "error en comunicacion con gruerosOnline" );
  });

}
function AbrirGruaEstatus(Estatus) {
  $.ajax({
    url: link_servidor + "adm/Listas/index.php?action=lista_gruas&Estatus=" + Estatus + "&opcion=2",
    success: function(html){
      $('#popupListas .modal-body').html(html);
      $('#popupListas').modal('show');
    }
  });
}
