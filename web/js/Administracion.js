$("#Seleccionador").click(function(){
   ManejarSeleccion($(this));   
});

function ManejarSeleccion(e){
   if ($(e).is(':checked')) {
       $(".selec").prop("checked",true);
   }else{
       $(".selec").prop("checked",false);
   }
} 