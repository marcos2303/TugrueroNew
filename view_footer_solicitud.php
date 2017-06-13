<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">
        <div class="container">
          <div class="modal-header">
            <h3 class="modal-title" id="myModalLabel"></h3>
          </div>
              <div class="modal-body" >
                
              </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"> Cerrar</i></button>
          </div>
        </div>
    </div>                                      
</div>
<div class="modal fade" id="myMapModal" tabindex="-1" role="dialog" aria-labelledby="myMapModalLabel" aria-hidden="true" >
    <div class="modal-content">
        <div class="container">
          <div class="modal-header">
            <h3 class="modal-title" id="myMapModalLabel"></h3>
          </div>
              <div class="modal-body" >
                
                    
                        <div id="map-canvas" class=""></div>
                    
                
              </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal" id="close_map" data-backdrop="false"><i class="fa fa-close"> Cerrar</i></button>
          </div>
        </div>
    </div>                                      
</div>
			<div class="modal fade" id="myModalMessage" tabindex="-1" role="dialog" aria-labelledby="myModalMessageLabel">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalMessageLabel"></h4>
				  </div>
				  <div class="modal-body">
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				  </div>
				</div>
			  </div>
			</div>

			<div class="modal fade modal-lg" id="myModalCargando" tabindex="-2" role="dialog" aria-labelledby="myModalCargandoLabel">
			  <div class="modal-dialog modal-lg modal-dialog-center" role="document">
				<div class="modal-content">
				  <div class="modal-body">
					  <i class="fa fa-circle-o-notch fa-spin fa-5x"></i> Generando solicitud
				  </div>
				</div>
			  </div>
			</div>

</body>
</html>
<script src="<?php echo full_url;?>/web/js/jquery.js"></script>
<script src="<?php echo full_url;?>/web/js/bootstrap.min.js"></script>
<script src="<?php echo full_url;?>/web/js/jqBootstrapValidation.js"></script>
<script src="<?php echo full_url;?>/web/js/datatables.js"></script>
<script src="<?php echo full_url;?>/web/js/fnReloadAjax.js"></script>

<script type="text/javascript" src="<?php echo full_url;?>/web/bootstrap/js/moment/moment.js"></script>
<script type="text/javascript" src="<?php echo full_url;?>/web/bootstrap/js/transition.js"></script>
<script type="text/javascript" src="<?php echo full_url;?>/web/bootstrap/js/collapse.js"></script>
<script type="text/javascript" src="<?php echo full_url;?>/web/bootstrap/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo full_url;?>/web/bootstrap/js/moment/locale/es.js"></script>

<!--<script src="<?php echo full_url;?>/web/js/jquery-validation-1.14.0/dist/additional-methods.js"></script>-->
<script type="text/javascript">
	$(document).ready(function(){
		
        $('#datetimepicker1,#datetimepicker2,#datetimepicker3,#datetimepicker4,#datetimepicker5,#datetimepicker6,#desde,#hasta,#FechaSolicitud,#VigenciaDesde,#VigenciaHasta,#FechaNacimiento').datetimepicker({
			 viewMode: 'days',
			 locale: 'es',
			 format: 'DD/MM/YYYY',
			 //useCurrent: true,
			 showTodayButton: true,
			 showClear: true,
                         inline: false,
			 showClose: true,
			tooltips: {
				today: 'Ir a hoy',
				clear: 'Limpiar selección',
				close: 'Cerrar el calendario',
				selectMonth: 'Seleccionar mes',
				prevMonth: 'Mes anterior',
				nextMonth: 'Próximo mes',
				selectYear: 'Seleccionar año',
				prevYear: 'Previous Year',
				nextYear: 'Próximo año',
				selectDecade: 'Select Decade',
				prevDecade: 'Previous Decade',
				nextDecade: 'Next Decade',
				prevCentury: 'Previous Century',
				nextCentury: 'Next Century'
			}
			 
        });		
	});
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-80903818-1', 'auto');
  ga('send', 'pageview');

</script>
