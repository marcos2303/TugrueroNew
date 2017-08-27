var key = "TEST-6d4e759f-3000-4816-bb77-45ce06df576e";
Mercadopago.setPublishableKey(key);  
function initializeMP(){
    Mercadopago.setPublishableKey(key);  
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

    var bin = getBin();
    //console.log(event);
    if (event == "keyup") {
        if ($(element).val().length >= 6) {
            //console.log("mayor a 6");
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
    if (status == 200) {

        // do somethings ex: show logo of the payment method
        //var form = document.querySelector('#pay');
        var form = $('#DataForm')[0];
        if ($("#TipoTarjeta")[0] == null) {
            //console.log("no existe el input");
            var paymentMethod = document.createElement('input');
            paymentMethod.setAttribute('name', "TipoTarjeta");
            paymentMethod.setAttribute('type', "hidden");
            paymentMethod.setAttribute('id', "TipoTarjeta");
            paymentMethod.setAttribute('class', "SaveAutomaticoServicioPrecio MP");
            paymentMethod.setAttribute('value', response[0].id);
            //console.log(paymentMethod);
            form.appendChild(paymentMethod);
        } else {
            $("#TipoTarjeta").val(response[0].id);
        }
    }
}

function doPay(){
    $("#Pagar").attr("disabled","disabled");
    if(!doSubmit){
        var $form = document.querySelector('#DataForm');
        Mercadopago.createToken($form, sdkResponseHandler); // The function "sdkResponseHandler" is defined below

        return false;
    }
};
function sdkResponseHandler(status, response) {
    
    if (typeof response.cause !== 'undefined') {
        $('#ErroresMP').html("");
        $("#Pagar").attr("disabled",false);
        console.log(response.cause);
        $.each(response.cause, function(i, item) {
            console.log(item.description);
            $('#ErroresMP').append("<label class='alert alert-danger'>"+ item.description + "</label>");
          
        });
    }
    if (status != 200 && status != 201) {
        $("#Pagar").attr("disabled",false);
        console.log("verificar datos");
         $('#ErroresMP').append("<label class='alert alert-danger'>Verificar datos</label>");
        //alert(status);

    }else{
        $('#ErroresMP').html("");
        
        var form = document.querySelector('#DataForm');
        var card = document.createElement('input');
        card.setAttribute('name',"token");
        card.setAttribute('type',"hidden");
        card.setAttribute('id',"token");
        card.setAttribute('value',response.id);
        card.setAttribute('class',"MP");
        form.appendChild(card);
        var token = $('#token').val();
        var precio = 5000;
        var descripcion = 'Descripcion';
        var email = "deandrademarcos@gmail1.com";
        var paymentMethodId = $('#TipoTarjeta').val();
        
        //console.log(response);
        $.ajax({
            url: "https://tugruero.com/mercadopago/pagoServicioDesarrollo.php?token="+token +"&paymentMethodId=" + paymentMethodId + "&precio=" + precio + "&email=" + email + "&descripcion=" + descripcion,
            data: response ,
            dataType: "json",
            error: function(response){
                $('#ErroresMP').append("<label class='alert alert-danger'>"+ "Error de comunicación con API en servidor www.tugruero.com" + "</label>");
                $("#Pagar").attr("disabled",false);
            },
            success: function(data){
                if (typeof data.error == 'undefined') { 
                    var status = data.response["status"];

                    if(status !='rejected'){
                        $('#SuccessMP').append("<label class='alert alert-info'>"+ status + "</label>");
                        $("#Pagar").hide();
                        $(".MP").prop("disabled","disabled");
                        $(".MP").prop("readonly","readonly");
                        GuardarAutomaticoServicioPrecio();
                    }else{
                        //console.log(data.response);
                        $('#ErroresMP').append("<label class='alert alert-danger'>"+ status + "</label>"); 
                        $("#Pagar").attr("disabled",false);
                    }
  
                }else{
                    $('#ErroresMP').append("<label class='alert alert-danger'>"+ data.error + "</label>"); 
                    $("#Pagar").attr("disabled",false);
                }                          
            }
        });
    }
};
