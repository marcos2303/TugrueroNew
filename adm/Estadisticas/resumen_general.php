<?php include('../../view_header_admin.php')?>
<?php include('../menu.php')?>
	<div class="col-sm-3">
		<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">BD</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				  <table class="table table-bordered">
					<tr>
					  <th>Efectivos</th>
					  <th>Agendados</th>
					  <th>Fallidos</th>
					  <th>Cancelados</th>
					</tr>
					<tr>
					  <td>1.</td>
					  <td>Update software</td>
					  <td>
						<div class="progress progress-xs">
						  <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
						</div>
					  </td>
					  <td><span class="badge bg-red">55%</span></td>
					</tr>
					<tr>
					  <td>2.</td>
					  <td>Clean database</td>
					  <td>
						<div class="progress progress-xs">
						  <div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
						</div>
					  </td>
					  <td><span class="badge bg-yellow">70%</span></td>
					</tr>
					<tr>
					  <td>3.</td>
					  <td>Cron job running</td>
					  <td>
						<div class="progress progress-xs progress-striped active">
						  <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
						</div>
					  </td>
					  <td><span class="badge bg-light-blue">30%</span></td>
					</tr>
					<tr>
					  <td>4.</td>
					  <td>Fix and squish bugs</td>
					  <td>
						<div class="progress progress-xs progress-striped active">
						  <div class="progress-bar progress-bar-success" style="width: 90%"></div>
						</div>
					  </td>
					  <td><span class="badge bg-green">90%</span></td>
					</tr>
				  </table>
				</div>
		</div>	
	</div>
	<div class="col-sm-3">
		<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Bordered Table</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				  <table class="table table-bordered">
					<tr>
					  <th style="width: 10px">#</th>
					  <th>Task</th>
					  <th>Progress</th>
					  <th style="width: 40px">Label</th>
					</tr>
					<tr>
					  <td>1.</td>
					  <td>Update software</td>
					  <td>
						<div class="progress progress-xs">
						  <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
						</div>
					  </td>
					  <td><span class="badge bg-red">55%</span></td>
					</tr>
					<tr>
					  <td>2.</td>
					  <td>Clean database</td>
					  <td>
						<div class="progress progress-xs">
						  <div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
						</div>
					  </td>
					  <td><span class="badge bg-yellow">70%</span></td>
					</tr>
					<tr>
					  <td>3.</td>
					  <td>Cron job running</td>
					  <td>
						<div class="progress progress-xs progress-striped active">
						  <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
						</div>
					  </td>
					  <td><span class="badge bg-light-blue">30%</span></td>
					</tr>
					<tr>
					  <td>4.</td>
					  <td>Fix and squish bugs</td>
					  <td>
						<div class="progress progress-xs progress-striped active">
						  <div class="progress-bar progress-bar-success" style="width: 90%"></div>
						</div>
					  </td>
					  <td><span class="badge bg-green">90%</span></td>
					</tr>
				  </table>
				</div>
		</div>	
	</div>

<?php include('../../view_footer_admin.php')?>