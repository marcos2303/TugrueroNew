<?php include("autoload.php");
$PreguntasFrecuentes = new PreguntasFecuentes();
$lista_preguntas = $PreguntasFrecuentes->getPreguntasRespuestas();

?>

<!doctype html>
<html ng-app="cssawds">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Grueros Venezuela, Grúas Venezuela">
    <meta name="author" content="">
    <link href="web/css/bootstrap.css" rel="stylesheet">
    <link rel="icon" href="web/img/favicon.ico" type="image/x-icon"/>
    <link href="web/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300|Roboto:400,300,500,700">
    <!-- <link rel="stylesheet" href="http://cssa.cssawards123.netdna-cdn.com/wp-content/themes/cssawds/assets/css/cssawds.min.css"> -->
    <link rel="stylesheet" href="web/css/menu.css">  
	<link rel="stylesheet" href="web/css/hover.css">  
	<link href="web/css/freelancer.css" rel="stylesheet">
        <title>TUGRUERO®</title>
</head>
<body id="page-top" class="index" class="">
	<div class="col-sm-12 navbar-default" style="padding-bottom: 10px;" align="center">
		<a class="visible-md visible-lg" href="<?php echo full_url?>/index.php"><img class="img-logo" src="web/img/logo_blanco.png" alt="" width="220"></a>
	</div>
	<section id="contact" class="success5">
        <div class="container">
            <div class="row">
				
	
                <div class="col-lg-12 text-center">
					<br>
					<h2 class="text-center white-font big_title"><b class="white-font big_title">Preguntas frecuentes</b></h2>
					<br>
					<br>
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					<?php foreach($lista_preguntas as $lista):?>
					<!--Ini-->									
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="heading<?php echo $lista['Id']?>" style="background-color: #404040;">
							
						  <h4 class="panel-title extra_bold text-left ">
							<a class="collapsed extra_bold white-font" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $lista['Id']?>" aria-expanded="false" aria-controls="collapseThree">
							  <?php echo $lista['Pregunta'];?>
							</a>
						  </h4>
						</div>
						<div id="collapse<?php echo $lista['Id']?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $lista['Id']?>">
							<div class="panel-body" style="background-color: #464646;">
							  <?php echo $lista['Respuesta'];?>
							</div>
						</div>
					</div>
					<!--Fin-->
					<?php endforeach;?>
				</div>	
					
				</div>
			</div>
		</div>
	</section>
</body>
</html>
<script src="web/js/jquery.js"></script>
<script src="web/js/bootstrap.min.js"></script>
<script>
var $myGroup = $('#myGroup');
$myGroup.on('show.bs.collapse','.collapse', function() {
    $myGroup.find('.collapse.in').collapse('hide');
});

</script>

