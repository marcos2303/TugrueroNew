<?php include('../../view_header_app.php')?>
<?php include('../menu.php')?>

	<h1 class="text-center">Servicios Clientes</h1>
	<form class="form-inline"  action="" id="consultarPoliza">
          <div class="form-group">
            <label for="letra">Cédula/RIF</label>
            <select name="nacion" id="letra"  class="form-control">
                <option value="V">V</option>
                <option value="E">E</option>
                <option value="J">J</option>
            </select>
            <input type="text" class="form-control" autocomplete="off" id="documento" placeholder="1234567">
			<label for="placa">Placa</label>
			<input type="text" class="form-control" autocomplete="off" id="placa" placeholder="AC785FD" maxlength="8">
          </div>
		  
          <button type="submit" class="btn btn-default"><i class="fa fa-search fa-pull-left fa-border"></i> Consultar</button>
        </form>
        <div id="results" class="col-sm-12" hidden>
            <div id="" class="col-sm-12">
                <div class="panel panel-default">
                  <div class="panel-heading" style="background-color: #404040 !important;">
                    <h3 class="panel-title" style="color: white !important;">Datos Póliza</h3>
                  </div>
                  <div class="panel-body" id="parcial_cliente" style="background-color: #ccc !important;"></div>
                  <div class="panel-body" id="parcial_poliza" style="background-color: #ccc !important;"></div>

                </div>
            </div>                        
            <div id="" class="col-sm-12">
                <div class="panel panel-default">
                  <div class="panel-heading" style="background-color: #404040 !important;">
                    <h3 class="panel-title" style="color: white !important;">Tips de Condicionado</h3>
                  </div>
                 <div class="panel-body" id="parcial_tips" style="background-color: #ccc !important;">

                  </div>
                </div>
            </div>                
        </div> 
        <div class="panel-body" id="botones">

        </div>
        <div id="nuevo" class="col-sm-12" hidden>
            <a class="btn btn-default"  href="<?php echo full_url."/adm/Polizas/index.php?action=new"?>"><i class="fa fa-file-o fa-pull-left fa-border"></i>Agregar póliza</a> 
        </div>

	<?php include('../../view_footer_solicitud.php')?>
<script>

	$("document").ready(function(){
		
		$("#consultarPoliza").on("submit", function(){
		  //Code: Action (like ajax...)
		  consultarPoliza();
		  return false;
		});
		$('#results').hide();
		
	});

function consultarPoliza(){                              
				$('#results').hide();
				$('#nuevo').hide();          
                if($('#documento').val() == '' && $('#placa').val() == '')
                {
				alert('Debe indicar el número de identificación del cliente o la placa del vehículo');
				return false;
				}
                var z1 = /^[0-9]*$/;
				if ($('#documento').val() != '' && !z1.test($('#documento').val())) { 
						alert('Por favor solo ingrese números. Letras, caracteres especiales y espacios NO son admitidos');
						return false;
				}             
				var arr = {
					Cedula: $('#letra').val() + '-' + $('#documento').val() ,
                    action: "individual_json",
					Placa: $('#placa').val()
				};
				$.ajax({
					type: "POST",
					url: '<?php echo full_url?>/adm/ServiciosClientes/index.php?action=individual_json',
					data: arr,
                                        dataType: 'json',
					success: function(data){
                                            
                                            if(data)
                                            {
                                                $('#results').show();
                                                var idPoliza = data.idPoliza;
                                               //carga parcial de cliente
                                                $.ajax({
                                                  type: "GET",
                                                  url: '<?php echo full_url?>/adm/Parciales/index.php',
                                                  data: { action: "parcial_cliente",idPoliza: idPoliza},
                                                  success: function(html){
                                                                $('#parcial_cliente').html(html);
                                                  },
                                                 
                                                });
                                                //carga parcial de Poliza
                                                $.ajax({
                                                  type: "GET",
                                                  url: '<?php echo full_url?>/adm/Parciales/index.php',
                                                  data: { action: "parcial_poliza",idPoliza: idPoliza},
                                                  success: function(html){
                                                                $('#parcial_poliza').html(html);
                                                  }
                                                });     
												//carga parcial de tips
												$.ajax({
                                                  type: "GET",
                                                  url: '<?php echo full_url?>/adm/Parciales/index.php',
                                                  data: { action: "parcial_tips",idPoliza: idPoliza},
                                                  success: function(html){
                                                                $('#parcial_tips').html(html);
                                                  }
                                                }); 
                                                var html = '';
                                                html+='<a  class="btn btn-default" id="" href="<?php echo full_url;?>/adm/solicitud/index.php?action=new&idPoliza='+idPoliza+'"><i class="fa fa-map-marker fa-pull-left fa-border"></i> Generar solicitud</a>';
                                                html+='<a  class="btn btn-default" id="" href="<?php echo full_url;?>/adm/ServiciosClientes/index.php?idPoliza='+idPoliza+'"><i class="fa fa-mobile fa-pull-left fa-border"></i> Consultar servicios</a>';
                                                $('#botones').html(html);
                                            }
                                            else
                                            {
                                                alert('No se encontró póliza registrada con los datos suministrados');
                                                 $('#nuevo').show();
												 $('#results').hide();
                                            }
                                                
                                           
						
					}
				});	


				
}
</script>