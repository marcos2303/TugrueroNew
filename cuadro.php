<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Grueros Venezuela, Grúas Venezuela">
    <meta name="author" content="tugruero">
    <meta name="google-site-verification" content="kXlZJPIsjo2kzjHRJpgR4ncAn-g_bF5ipNOvRSkhsE0" />
    <link rel="alternate" hreflang="es" href="www.tugruero.com" />
    <link rel="icon" href="web/img/favicon.ico" type="image/x-icon"/>
    <title>TUGRUERO®</title>
    <!-- Bootstrap Core CSS -->
    <link href="web/css/bootstrap.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="web/css/freelancer2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="web/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="web/css/animate.min.css" />
</head>
<body id="page-top" class="index">
<br>
<div class="col-xs-3 col-xs-offset-4" style=";margin-bottom: -1.9%;z-index: 1;background-color: #fff !important;">
    <img src="web/img/fresh/atencion.png" class="img-responsive">
</div>
<div class="col-xs-12 table-responsive" style="z-index: 0;border-top: dotted 3px #e76115;border-bottom: dotted 3px #e76115;border-left: dotted 3px #e76115;border-right: dotted 3px #e76115; z-index:0;">
    <div class="col-xs-12"  style="border: dotted 1px #000;margin-top: 3%;margin-bottom: 3%;background-color: #e7e8eb;padding-top: 2%;">
        <div class="" style="background-color: #444142;margin-left: -1.8%;margin-right: -1.8%;color:#fff;">
              <p class="text-center"><strong>SOLO SE PUEDE CONTRATAR EL PLAN PARA UN (01) VEHÍCULO A LA VEZ</strong></p>  
        </div>
        <div class="" style="margin-left: -3%;">
            <p class="text-center" style="font-size: 1.5em;">Si usted realizó el pago por transferencia o depósito<br>
                bancario asegúrese de tener el recibo o voucher<br>
                digitalizado en su equipo, ya que lo tendrá que <br>
                cargar al finalizar el proceso de contratación
            </p>
            
        </div>     
        <div class="" style="background-color: #e76115;border-radius: 10px;color:#ffffff !important;">
            <p class="text-left" style="font-size: 1.5em;">
                &nbsp;&nbsp;&nbsp;<strong>Asegúrese de tener digitalizado en su equipo los siguientes documentos</strong>
            </p>
            <ul style="font-size: 1.3em;">
                <li>Cédula de identidad.</li>
                <li>RIF personal.</li>
                <li>Licencia de conducir.</li>
                <li>Carnet de circulación.</li>
                <li>Certificado médico (en caso de adquirir RCV).</li>
                <li>Certificado de origen del vehículo. (Título de propiedad) (en caso de adquirir RCV)</li>
            </ul>
        </div>     
    
    </div>
	
</div>    
<div class="col-sm-12 col-md-6 col-md-offset-3 text-right">
    <br>
    <a class="btn btn-success" href="https://tugruero.com/pl/planes/index.php">Continuar</a>
</div>
</body>

    <!-- jQuery -->
    <script src="web/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="web/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="<?php echo full_url?>/web/js/jqBootstrapValidation.js"></script>
    <script src="<?php echo full_url?>/web/js/contact2_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="web/js/freelancer.js"></script>
	<script src="web/js/jquery.bootstrap-autohidingnavbar.js"></script>
        <script src="web/js/jquery.inview.js"></script>

</body>

</html>
<script>

  $(document).ready(function(){
	  TextCaja(1);
          $('#animationSandbox').hide();
          $('#animationSandbox2').hide();
          $('#imagen').hide();

        $("#gruero_plus").bind("inview", function(isVisible) {
          // Event is triggered once the element becomes visible in the browser's viewport, and once when it becomes invisible
          if (isVisible) {
            //console.log("element #foobar became visible in the browser's viewport");
                $('#animationSandbox').show();
                $('#animationSandbox2').show();
                $('#imagen').show();               
                
                if($('#animate1').val()==0){
                    testAnim2('slideInLeft');
                    testAnim('slideInRight');
                    testAnim3('slideInUp');
                    $('#animate1').val(1);
                    $('#animate2').val(1);
                    $('#animate3').val(1);  
                }


          } else {
            //console.log("element #foobar became invisible in the browser's viewport");
          }
        });
  });
  
  
  
	function openAdvertencia(){
		
		$('#myModal').modal('toggle');
		$('#myModal2').modal('show');
	}
  function TextCaja(caja)
  {
	  var text = '';
		$("#nosotros").css("background-image", "url(web/img/fresh/nosotros.png)");
		$("#quehacemos").css("background-image", "url(web/img/fresh/quehacemos.png)");
		$("#adondevamos").css("background-image", "url(web/img/fresh/adondevamos.png)");
		$("#comofuncionamos").css("background-image", "url(web/img/fresh/comofuncionamos.png)");
		if(caja == 1)//nosotros
		{
			text = "Somos una empresa venezolana de base tecnológica dedicada al auxilio y asistencia vial mediante una aplicación móvil y centro de monitoreo. Trabajamos las 24 horas del día y los 365 días del año. Buscamos a los grueros vía GPS y garantizamos un tiempo de respuesta menor a 30 minutos.";
			$("#nosotros").css("background-image", "url(web/img/fresh/nosotros2.png)");
		
		}else if(caja == 2){//que hacemos
			text = "Ofrecemos tranquilidad a los accidentados en la vía entregándoles el mejor servicio de auxilio vial por medio de nuestra excelente plataforma de comunicación.";
			$("#quehacemos").css("background-image", "url(web/img/fresh/quehacemos2.png)");			  
		}else if(caja == 3){//a donde vamos
			text = "TU/GRUERO® se perfila a ser la plataforma tecnológica número uno a nivel mundial en auxilio vial, teniendo la red de grueros más amplia, trabajando con el 100% de las compañías de seguro existentes y la mayor cantidad de personas no aseguradas del mercado";
			$("#adondevamos").css("background-image", "url(web/img/fresh/adondevamos2.png)");	
		}else if(caja == 4){//como funcionamos
			text = "<strong> Puedes disfrutar de nuestros servicios de las siguientes formas: </strong><br><br>";
                        text+= "<ol>";
			text+= "<li> <label style='text-decoration: underline;'>Compañías de Seguros:</label> Si tu compañía de seguros está afiliada a nuestros servicios, tan solo te basta tener tu póliza de automóvil con Asistencia en Viajes (consulta con tu corredor de seguros)</li>";
                        text+= "<li> <label style='text-decoration: underline;'>Planes TU/GRUERO®:</label> Adquiriendo cualquiera de nuestros Planes de Grúas ilimitados (TU/GRUERO® Plus o TU/GRUERO® Gold)</li>";
                        text+= "<li> <label style='text-decoration: underline;'>Servicios particulares:</label> Si no estás amparado por ninguna de las dos soluciones anteriores, puedes pedir tu servicio de grúa de forma particular usando nuestra App o llamando a nuestro Call Center y pagar por el servicio puntual.</li>";
                        text+= "</ol>";
                        $("#comofuncionamos").css("background-image", "url(web/img/fresh/comofuncionamos2.png)");	
		}
	   
		$('#caja').html(text);
	  
  }
    
  function testAnim(x) {
    $('#animationSandbox').removeClass().addClass(x + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
      $(this).removeClass();
    });
  };
  function testAnim2(x) {
    $('#animationSandbox2').removeClass().addClass(x + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
      $(this).removeClass();
    });
  };
  function testAnim3(x) {
    $('#imagen').removeClass().addClass(x + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
      $(this).removeClass();
    });
  }; 
</script>
    <script>
      $("nav.navbar-fixed-top").autoHidingNavbar();
    </script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-80903818-1', 'auto');
  ga('send', 'pageview');

</script>
