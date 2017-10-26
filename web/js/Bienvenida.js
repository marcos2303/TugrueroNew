
  $(document).ready(function(){

    var jqxhr = $.get( link_servidor + "/servicios/adminapp/servicios_usuario.php", function(datos) {
    })
    .done(function(datos) {
      $.each(datos.data, function(index, item) {
          $("#" + index).html(item);
      });
    })
    .fail(function() {
      alert( "error" );
    });
  });
