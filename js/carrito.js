$(document).ready(function(){
    calcularTotal();
    recuperarLSCarritoCompra();
    contarProductos();
    recuperarLSCarrito();
    $(document).on('click','.agregar-carrito',(_e)=>{
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('prodId');
        const nombre = $(elemento).attr('prodNombre');
        const concentracion = $(elemento).attr('prodConcentracion');
        const adicional = $(elemento).attr('prodAdicional');
        const precio = $(elemento).attr('prodPrecio');
        const laboratorio = $(elemento).attr('prodLaboratorio');
        const tipo = $(elemento).attr('prodTipo');
        const presentacion = $(elemento).attr('prodPresentacion');
        const avatar = $(elemento).attr('prodAvatar');
        const stock = $(elemento).attr('prodStock');

        const producto ={
            id: id,
            nombre: nombre,
            concentracion: concentracion,
            adicional: adicional,
            precio: precio,
            laboratorio: laboratorio,
            tipo: tipo,
            presentacion: presentacion,
            avatar: avatar,
            stock: stock,
            cantidad: 1
        }
        let id_producto;
        let productos;
        productos = recuperarLS();
        productos.forEach(prod =>{
            if(prod.id === producto.id){
                id_producto = prod.id;
            }
        });
        if(id_producto === producto.id){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'El producto ya ha sido agregado al carrito'
              });
        }else{
            template = `
                <tr prodId="${producto.id}">
                    <td>${producto.id}</td>
                    <td>${producto.nombre}</td>
                    <td>${producto.concentracion}</td>
                    <td>${producto.adicional}</td>
                    <td>${producto.precio}</td>
                    <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
                </tr>
            `;
            $('#lista').append(template);
            agregarLS(producto);
            let contador;
            contarProductos();
        }
        
    });
    $(document).on('click','.borrar-producto',(e)=>{
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('prodId');
        elemento.remove();
        eliminarProductoLS(id);
        contarProductos();
        calcularTotal()
    });
    $(document).on('click','#vaciar-carrito',(e)=>{
        $('#lista').empty();
        eliminarLS();
        contarProductos();
    });
    $(document).on('click','#procesar-pedido',(e)=>{
        procesarPedido();
    });
    $(document).on('click','#procesar-compra',(e)=>{
        procesarCompra();
    });
    function recuperarLS(){
        let productos;
        if(localStorage.getItem('productos') === null){
            productos = [];
        }else{
            productos = JSON.parse(localStorage.getItem('productos'));
        }
        return productos;
    }
    function agregarLS(producto){
        let productos;
        productos = recuperarLS();
        productos.push(producto);
        localStorage.setItem('productos',JSON.stringify(productos));
    }
    function recuperarLSCarrito(){
        let productos, id_producto;
        productos = recuperarLS();
        funcion = "buscar_id"
        productos.forEach(producto => {
            id_producto = producto.id;
            $.post('../controlador/ProductoControler.php',{funcion,id_producto},(response)=>{
                let template_carrito = '';
                let json = JSON.parse(response);
                template_carrito = `
                    <tr prodId="${json.id}">
                        <td>${json.id}</td>
                        <td>${json.nombre}</td>
                        <td>${json.concentracion}</td>
                        <td>${json.adicional}</td>
                        <td>${json.precio}</td>
                        <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
                    </tr>
                `;
                $('#lista').append(template_carrito);
            });
        });
    }
    function eliminarProductoLS(id){
        let productos;
        productos = recuperarLS();
        productos.forEach(function(producto,indice){
            if(producto.id === id){
                productos.splice(indice,1);
            }
        });
        localStorage.setItem('productos',JSON.stringify(productos));
    }
    function eliminarLS(){
        localStorage.clear();
    }
    function contarProductos(){
        let productos;
        let contador = 0;
        productos = recuperarLS();
        productos.forEach(producto => {
            contador ++;
        });
        $('#contador').html(contador);
    }
    function procesarPedido(){
        let productos;
        productos = recuperarLS();
        if(productos.length === 0){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'El carrito está vacío.'
              });
        }else{
            location.href = '../vista/adm_compra.php';
        }
    }
    function recuperarLSCarritoCompra(){
        let productos, id_producto;
        productos = recuperarLS();
        funcion = "buscar_id"
        productos.forEach(producto => {
            id_producto = producto.id;
            $.post('../controlador/ProductoControler.php',{funcion,id_producto},(response)=>{
                let template_compra = '';
                let json = JSON.parse(response);
                template_compra = `
                    <tr prodId="${producto.id}" prodPrecio="${json.precio}">
                        <td>${json.nombre}</td>
                        <td>${json.stock}</td>
                        <td class="precio">${json.precio}</td>
                        <td>${json.concentracion}</td>
                        <td>${json.adicional}</td>
                        <td>${json.laboratorio}</td>
                        <td>${json.presentacion}</td>
                        <td>
                            <input type="number" min="1" class="form-control cantidad-producto" value="${producto.cantidad}">
                        </td>
                        <td class="subtotales">
                            <h5>${json.precio * producto.cantidad}</h5>
                        </td>
                        <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
                    </tr>
                `;
                $('#lista-compra').append(template_compra);
            });
        });
    }
    $(document).on('click','#actualizar',(e)=>{
        let productos, precios;
        precios = document.querySelectorAll('.precio');
        productos = recuperarLS();
        productos.forEach(function(producto,indice){
            producto.precio = precios[indice].textContent;
        });
        localStorage.setItem('productos',JSON.stringify(productos));
        calcularTotal();
    });
    $('#cp').keyup((e)=>{
        let id, cantidad, producto, productos, montos, precio;
        producto = $(this)[0].activeElement.parentElement.parentElement;
        id = $(producto).attr('prodId');
        precio = $(producto).attr('prodPrecio');
        cantidad = producto.querySelector('input').value;
        montos = document.querySelectorAll('.subtotales');
        productos = recuperarLS();
        productos.forEach(function(prod,indice) {
            if(prod.id === id){
                prod.cantidad = cantidad;
                prod.precio = precio;
                montos[indice].innerHTML = `<h5>${cantidad * productos[indice].precio}</h5>`;
            }
        });
        localStorage.setItem('productos',JSON.stringify(productos));
        calcularTotal();
    });
    function calcularTotal(){
        let productos, subtotal, con_iva, total_sin_descuento, pago, vuelto, descuento;
        let total = 0, iva = 0.12;
        productos = recuperarLS();
        productos.forEach(producto => {
            let subtotal_producto = Number(producto.precio * producto.cantidad);            
            total = total + subtotal_producto;
        });
        pago = $('#pago').val();
        descuento = $('#descuento').val()
        // Calculando totales y subtotales para los cards en el proceso de una venta
        total_sin_descuento = total.toFixed(2);
        con_iva = parseFloat(total * iva).toFixed(2);
        subtotal = parseFloat(total - con_iva).toFixed(2);
        total = total - descuento;
        vuelto = pago - total;
        // Envía los datos de arriba al html adm_compra.php
        $('#subtotal').html(subtotal);
        $('#con-iva').html(con_iva);
        $('#total-sin-descuento').html(total_sin_descuento);
        $('#total').html(total.toFixed(2));
        $('#vuelto').html(vuelto.toFixed(2));
    }
    function procesarCompra(){
        let nombre, nit;
        nombre = $('#cliente').val();
        nit = $('#nit').val();
        if(recuperarLS().length == 0){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'No hay productos seleccionados, seleccione algunos.'
              }).then(function(){
                  location.href = '../vista/adm_catalogo.php';
              });
        }else if(nombre == ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Se necesita un nombre de cliente.'
              });
        }else{
            verificarStock().then(error=>{
                if(error == 0){
                    registrarCompra(nombre,nit);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Compra realizada correctamente.',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(){
                        eliminarLS();
                        location.href = '../vista/adm_catalogo.php';
                    });
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Hay conflicto en el stock de algún producto.'
                      });
                }
            });
            
        }
    }
    //Verificando Stock
    async function verificarStock() {
        let productos;
        funcion = 'varificar_stock';
        productos = recuperarLS();
        const response = await fetch('../controlador/ProductoControler.php',{
            method: 'POST',
            headers: {'Content-Type':'application/x-www-form-urlencoded'},
            body: 'funcion='+funcion+'&&productos='+JSON.stringify(productos)
        });
        let error = await response.text();

        return error;
    }
    function registrarCompra(nombre,dni){
        funcion = 'registrar_compra';
        let total = $('#total').get(0).textContent;
        let productos = recuperarLS();
        let json = JSON.stringify(productos);
        //Se envían los productos al controlador en php
        $.post('../controlador/CompraControler.php',{funcion,total,nombre,dni,json},(response)=>{
            console.log(response);
        });
    }

});