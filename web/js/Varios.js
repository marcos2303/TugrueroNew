function calculaIva(iva, monto){
    iva = (iva * monto)/100;
       
    return iva;
}
function calculaPrecioCIva(iva, monto){
    var precio = 0;
    precio = monto + ((iva * monto)/100);
       
    return precio;
}

