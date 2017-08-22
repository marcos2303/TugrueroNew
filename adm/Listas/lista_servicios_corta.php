<table id="Servicios" class="table-small table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>Código</th>
      <th>Tipo servicio</th>
      <th>Estatus</th>
      <th>Inicio</th>
      <th>Fin</th>
      <th>NombresCliente</th>
      <th>CedulaCliente</th>
      <th>PlacaCliente</th>
      <th>Detalle</th>
    </tr>
  </thead>
  <tbody>
    <?php if(isset($servicios_list) and count($servicios_list)>0):?>
      <?php foreach($servicios_list as $servicio):?>
    <tr>
      <td><?php echo $servicio['CodigoServicio']?></td>
      <td><?php echo $servicio['NombreServicioTipo']?></td>
      <td><?php echo $servicio['NombreEstatus']?></td>
      <td><?php echo $servicio['Inicio']?></td>
      <td><?php echo $servicio['Fin']?></td>
      <td><?php echo $servicio['NombresCliente']?> <?php echo $servicio['ApellidosCliente']?></td>
      <td><?php echo $servicio['CedulaCliente']?></td>
      <td><?php echo $servicio['PlacaCliente']?></td>
      <td>				<div class="btn-group">
				<button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-gear"></i> <span class="caret"></span>
				</button>
				<ul class="dropdown-menu dropdown-menu-right">
				<li><a href="#" onclick="DetalleServicio(<?php echo $list['IdServicio']?>)"> Detalle servicio</a></li>
				</ul>
				</div></td>
    </tr>
    <?php endforeach;?>
    <?php endif;?>
  </tbody>
</table>
<?php if(isset($values['regresar']) and $values['regresar'] == 1):?>
  <a href="#" class="btn btn-default" onclick="ListarGruas(<?php echo $values['IdProveedor']?>);"><i class="fa fa-arrow-circle-left"></i> Regresar</a>

<?php endif;?>
