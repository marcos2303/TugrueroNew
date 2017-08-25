var key = "TEST-6d4e759f-3000-4816-bb77-45ce06df576e";
function initializeMP(){
Mercadopago.setPublishableKey("TEST-6d4e759f-3000-4816-bb77-45ce06df576e");  
//addEvent(document.querySelector('input[id="NumeroTarjeta"]'), 'keyup', guessingPaymentMethod);
//addEvent(document.querySelector('input[id="NumeroTarjeta"]'), 'change', guessingPaymentMethod);
$('#NumeroTarjeta').on('change', function() {
  guessingPaymentMethod('change',this);
});
$('#NumeroTarjeta').on('keyup', function() {
  guessingPaymentMethod("keyup",this);
});
$('#Pagar').on('click', function() {
        doPay();
});
doSubmit = false;
//addEvent(document.querySelector('#pay'),'submit',doPay); 
}



function getBin() {
var ccNumber = $("#NumeroTarjeta")[0];
    return ccNumber.value.replace(/[ .-]/g, '').slice(0, 6);
};
function guessingPaymentMethod(event,element) {
Mercadopago.setPublishableKey(key);  
var bin = getBin();
    //console.log(event);
    if (event == "keyup") {
        if ($(element).val().length >= 6) {
        console.log("mayor a 6");
        Mercadopago.getPaymentMethod({
            "bin": bin
            }, setPaymentMethodInfo);
        }
    }
    else{
        setTimeout(function() {
            if (bin.length >= 6) {
                Mercadopago.getPaymentMethod({
                "bin": bin
                }, setPaymentMethodInfo);
            }
        }, 100);
    }
}

function setPaymentMethodInfo(status, response) {
 Mercadopago.setPublishableKey(key);                           
    if (status == 200) {

    // do somethings ex: show logo of the payment method
    //var form = document.querySelector('#pay');

        if ($("#TipoTarjeta")[0] == null) {
        console.log("no existe el input");
        var paymentMethod = document.createElement('input');
        paymentMethod.setAttribute('name', "TipoTarjeta");
        paymentMethod.setAttribute('type', "text");
        paymentMethod.setAttribute('id', "TipoTarjeta");
        paymentMethod.setAttribute('class', "SaveAutomaticoServicioPrecio MP");
        paymentMethod.setAttribute('value', response[0].id);

        $("#tipo_tarjeta").append(paymentMethod);
        } else {
        $("#TipoTarjeta").val(response[0].id);
        }
    }
}

                        function doPay(){
                            Mercadopago.setPublishableKey(key);  
                            if(!doSubmit){
                                var $form = $('#DataForm .MP')[0];
                                Mercadopago.createToken($form, sdkResponseHandler); // The function "sdkResponseHandler" is defined below

                                return false;
                            }
                        };
                        function sdkResponseHandler(status, response) {
                            Mercadopago.setPublishableKey(key);  
                            if (typeof response.cause !== 'undefined') {
                              //alert(response.cause[0].code);
                              var error = array_errores_token[response.cause[0].code];
                              //alert(error);
                            }
                            
                            
                            
                            /*if(response.cause[0].code){
                                
                            }*/
                        
                            //alert(response.cause[0].code);
                            if (status != 200 && status != 201) {
                                console.log("verify filled data");
                                //alert(status);

                            }else{

                                
                                //var form = document.querySelector('#pay');
                                var card = document.createElement('input');
                                card.setAttribute('name',"token");
                                card.setAttribute('type',"text");
                                card.setAttribute('id',"token");
                                card.setAttribute('value',response.id);
                                //form.appendChild(card);
                                $("#tipo_tarjeta").append(card);
                                //doSubmit=true;
                                //form.submit();
                                var datos =  $('#DataForm .MP').serialize();
                                var token = $('#token').val();
                                var precio = 5000;
                                var descripcion = 'Descripcion';
                                var email = "deandrademarcos@gmail.com";
                                var paymentMethodId = $('#TipoTarjeta').val();
                                $.ajax({
                                   url: "https://tugruero.com/mercadopago/pagoServicioDesarrollo.php?token="+token +"&paymentMethodId=" + paymentMethodId + "&precio=" + precio + "&email=" + email + "&descripcion=" + descripcion,
                                   data: response ,
                                   dataType: "json",
                                   error: function(response){
                                       console.log("error");
                                   },
                                   success: function(data){
                                   //console.log(data.error);
                                    if (typeof data.error == 'undefined') { 
                                        var status = data.response["status"];
                                        //alert('no es undefined');
                                        //alert(status);
                                        //console.log('arriba');
                                        if(status !='rejected'){
                                            $.ajax({
                                                    url: "http://localhost/tugruero/pl/planes/index.php?action=pago&idSolicitudPlan=" + $('#idSolicitudPlan').val() + "&descripcion=" + descripcion + " #" + $('#idSolicitudPlan').val() + "&email=" + email,
                                                    data: data ,
                                                    dataType: "json",
                                                    error: function(response){
                                                        $('#ModalLoading').modal('toggle');
                                                    },
                                                    success: function(data){
                                                    //console.log(data);
                                                        if(data[0] == 'OK'){
                                                            $('#show_error').html("");
                                                            //$('#show_commit').html("<div class='alert alert-success'>Pago realizado</div>");
                                                            
                                                            $("#mercadopagodiv").html('');
                                                            $(".mercadopagodiv").html('');
                                                            $('#ModalLoading').modal('toggle');  
                                                            $("#mercadopagodivpagado").html("</br></br></br></br></br></br></br><div class='col-sm-3'></div><div  class='col-sm-6 alert alert-success'>¡LISTO! Ya procesamos su pago. Le hemos enviado un correo electrónico al indicado en el proceso de registro. Por favor revise su Bandeja de entrada o Spam.</div><div class='col-sm-3'></div><div class='col-sm-12 text-center'><a class='btn btn-success' href='http://www.tugruero.com'>Aceptar</a></div>");
                                                        }
                                                    }
                                            });   
                                        }else{
                                                //console.log(data.response);
                                                $('#ModalLoading').modal('toggle');  
                                                $('#show_error').html("<div class='alert alert-danger'>La transacción ha sido rechazada</div>");
                                                
                                            
                                            
                                        }
  
                                    }else{
                                        //alert("Revise la información suministrada");
                                        $('#ModalLoading').modal('toggle');
                                        $('#show_error').html("<div class='alert alert-danger'>Revise la información suministrada</div>");
                                    } 

                                       
                                       
                                   }
                                });




                            }
                        };
                        function getMessageErrorCodeToken(code){
     

                        };
     

