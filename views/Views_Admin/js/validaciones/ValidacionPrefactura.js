function register() {
    var cliente = document.getElementById("cliente").value; 
    var producto = document.getElementById("producto").value;
    var precio_unitario = document.getElementById("precio_unitario").value;
    var cantidad = document.getElementById("cantidad").value;
    var total_productos = document.getElementById("total_productos").value;
    var servicio = document.getElementById("servicio").value;
    var cantidad_servicios = document.getElementById("cantidad_servicios").value;
    var valor_total_servicios = document.getElementById("valor_total_servicios").value;
    var total_factura = document.getElementById("total_factura").value;
    if (cliente === "" || producto === "" || precio_unitario === "" || cantidad === "" || total_productos === "" || servicio === "" || cantidad_servicios === "" || valor_total_servicios === "" || total_factura === "") {
        alert ("Los campos estan vacios");
        return false;
    }
    
}