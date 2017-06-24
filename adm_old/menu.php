<?php
        $Menu = new Menu();
        $items_padres = $Menu ->getMenu(3, 1,0);?>
        <div class=""><!--menu mobile-->
                    <nav class="navbar navbar-default">
                      <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Cerrar/Abrir</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                          </button>
                          <a class="navbar-brand" href="<?php echo full_url;?>/adm/index.php?action=bienvenida"> <img src="<?php echo full_url;?>/web/img/logo_blanco.png" class="img-responsive" width="120"></a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                          
                           <ul class="nav navbar-nav navbar-right">
                            <?php foreach($items_padres as $item):?>
                                <li class="dropdown">
                                  <a class="dropdown-toggle small text-capitalize" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $item['name']?> <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                      <?php $items_hijos = $Menu -> getMenu(3,1,$item['id_menu']);?>
                                      <?php foreach($items_hijos as $item2):?>
                                        <li class=""><a class="small text-capitalize" href="<?php echo full_url.$item2['url']?>" target=""><?php echo $item2['name']?></a></li>
                                      <?php endforeach;?>
                                    </ul>
                                </li>
                            <?php endforeach;?>
                                <li class=""><a class="small text-capitalize" href="<?php echo full_url?>/adm/index.php?action=logout" target=""><i class="fa fa-sign-out"></i> Cerrar sesión</a></li>
                          </ul>
                        </div><!-- /.navbar-collapse -->
                      </div><!-- /.container-fluid -->
                    </nav>          
        </div><!--fin menu mobile-->
        <div class="col-sm-4 col-sm-offset-8">
            <div class="alert alert-dismissible text-right" role="alert">
						<label class=""><small>Grueros online</small></label>
                        <a class="btn btn-success" type="button" onclick="showOnline('SI')">
							<small> Si </small> <span class="badge"><small id="SI"> 0 </small></span>
                        </a>
                        <a class="btn btn-danger" type="button" onclick="showOnline('NO')">
							<small> No </small> <span class="badge"><small id="NO"> 0 </small></span>
                        </a>
                        <!--<a class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close"></i></a>-->

            </div>          
        </div>
<div class="modal fade" tabindex="-1" role="dialog" id="myModal2">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
			
		
		getGruerosOnline();
		
		setInterval( function () {
			getGruerosOnline()
		},60000 );
		
        function showOnline(status)
        {
			$('#myModal2 .modal-title').html('Estatus Grueros: ' + status);
			$('#myModal2').modal('show');
			$('#myModal2 .modal-body').html('Cargando...');
			$.ajax({
				type: "GET",
				url: '<?php echo full_url;?>/adm/ajax/index.php',
				data: { action: "grueros_online_detalle", status: status},
				timeout: 20000,
				error: function(jqXHR, textStatus, errorThrown) {
					if(textStatus==="timeout") {
					   $('#myModal2 .modal-body').html('Error leyendo los datos. Intente de nuevo mas tarde.');
					} 
				},
				success: function(html){
					$('#myModal2 .modal-body').html(html);
					
					
				}
			});
		}
		
		function getGruerosOnline()
		{
			$.ajax({
				type: "GET",
				url: '<?php echo full_url;?>/adm/ajax/index.php',
				data: { action: "grueros_online"},
				dataType: "json",
				timeout: 30000,
				error: function(jqXHR, textStatus, errorThrown) {
					if(textStatus==="timeout") {
					   $('#myModal2 .modal-body').html('Error leyendo los datos. Intente de nuevo mas tarde.');
					} 
				},
				success: function(json){
						$('#SI').html(json.SI);
						$('#NO').html(json.NO);
				}
			});
		}
		function gruerosEstados(zone_work, Disponible)
		{
			$('#myModal2 .modal-body').html('...');
			$('#myModal2 .modal-title').html('Estatus Grueros: ' + Disponible + " en " + zone_work);
			$.ajax({
				type: "GET",
				url: '<?php echo full_url;?>/adm/ajax/index.php',
				data: { action: "grueros_estados", zone_work: zone_work, Disponible: Disponible},
				timeout: 30000,
				error: function(jqXHR, textStatus, errorThrown) {
					if(textStatus==="timeout") {
					   $('#myModal2 .modal-body').html('Error leyendo los datos. Intente de nuevo mas tarde.');
					} 
				},
				success: function(html){
							$('#myModal2 .modal-body').html(html);
				}
			});
		}        
            function regresarGruerosOnline(zone_work, Disponible){
            
                
                showOnline(Disponible);
            }
</script>