$(document).ready(function(){
    var funcion;
    var edit = false;
    $('.select2').select2();
    rellenarLab();
    rellenarTipos();
    rellenarPres();
    buscarProducto();//Hace una búsqueda de los productos al iniciar la página
    rellenarProveedores();

    function rellenarProveedores(){
        funcion = "rellenar_proveedores";
        $.post('../controlador/ProveedorControler.php',{funcion},(response)=>{
            const proveedores = JSON.parse(response);
            let template='';
            proveedores.forEach(proveedor => {
                template+=`
                    <option value="${proveedor.id}">${proveedor.nombre}</option>
                `;
            });
            $('#proveedor').html(template);
        });
    }
    //Rellena los campos de los laboratorios a los que pertenece cada producto
    function rellenarLab(){
        funcion = "rellenar_lab";
        $.post('../controlador/LaboratorioControler.php',{funcion},(response)=>{
            const laboratorios = JSON.parse(response);
            let template='';
            laboratorios.forEach(laboratorio => {
                template+=`
                    <option value="${laboratorio.id}">${laboratorio.nombre}</option>
                `;
            });
            $('#laboratorio').html(template);
        });
    }
    function rellenarTipos(){
        funcion = "rellenar_tipos";
        $.post('../controlador/TipoControler.php',{funcion},(response)=>{
            const tipos = JSON.parse(response);
            let template='';
            tipos.forEach(tipo => {
                template+=`
                    <option value="${tipo.id}">${tipo.nombre}</option>
                `;
            });
            $('#tipo').html(template);
        });
    }
    function rellenarPres(){
        funcion = "rellenar_pres";
        $.post('../controlador/PresentacionControler.php',{funcion},(response)=>{
            const presentaciones = JSON.parse(response);
            let template='';
            presentaciones.forEach(presentacion => {
                template+=`
                    <option value="${presentacion.id}">${presentacion.nombre}</option>
                `;
            });
            $('#presentacion').html(template);
        });
    }
    //Botón crear de cada producto
    $('#form-crear-producto').submit(e=>{
        let id = $('#id-edit-prod').val();
        let nombre = $('#nombre-producto').val();
        let concentracion = $('#concentracion').val();
        let adicional = $('#adicional').val();
        let precio = $('#precio').val();
        let laboratorio = $('#laboratorio').val();
        let tipo = $('#tipo').val();
        let presentacion = $('#presentacion').val();
        //Compara la variable edit para ver que acción va a realizar, si editar o crear un producto
        if(edit == true){
            funcion = 'editar';
        }else{
            funcion = 'crear';
        }
        //Muestra los alerts de las acciones realizadas, crear, editar, eliminar, etc.
        $.post('../controlador/ProductoControler.php',{funcion,id,nombre,concentracion,adicional,precio,laboratorio,tipo,presentacion},(response)=>{

            if(response == 'added'){
                $('#added').hide('slow');
                $('#added').show(1000).delay(3000);
                $('#added').hide('slow');
                $('#form-crear-producto').trigger('reset');
                buscarProducto();
            }
            if(response == 'edit'){
                $('#edit-prod').hide('slow');
                $('#edit-prod').show(1000).delay(3000);
                $('#edit-prod').hide('slow');
                $('#form-crear-producto').trigger('reset');
                buscarProducto();
            }
            if(response == 'noadded'){
                $('#noadded').hide('slow');
                $('#noadded').show(1000).delay(3000);
                $('#noadded').hide('slow');
                $('#form-crear-producto').trigger('reset');
            }
            if(response == 'noedit'){
                $('#noadded').hide('slow');
                $('#noadded').show(1000).delay(3000);
                $('#noadded').hide('slow');
                $('#form-crear-producto').trigger('reset');
            }
            edit = false;
        });
        e.preventDefault();//Previene que la página se actualice para mostrar los productos
    });
    //Busca los productos y los muestra sin actualizar la página
    function buscarProducto(consulta){
        funcion = "buscar";
        $.post('../controlador/ProductoControler.php',{consulta,funcion},(response)=>{
            const productos = JSON.parse(response);
            let template = '';
            productos.forEach(producto =>{
                //Template de los cards donde se muestran los productos y sus especificaciones
                template += `
                <div prodId="${producto.id}" prodNombre="${producto.nombre}" prodPrecio="${producto.precio}" prodConcentracion="${producto.concentracion}" prodAdicional="${producto.adicional}" prodLaboratorio="${producto.laboratorio_id}" prodTipo="${producto.tipo_id}" prodPresentacion="${producto.presentacion_id}" prodAvatar="${producto.avatar}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                <div class="card bg-light">
                    <div class="card-header text-muted border-bottom-0">
                        <i class="fas fa-lg fa-cubes mr-1"></i>${producto.stock}
                    </div>
                    <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-7">
                        <h2 class="lead"><b>${producto.nombre}</b></h2>  
                        <h4 class="lead"><b>Q.${producto.precio}</b></h4>                      
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span> Concentración: ${producto.concentracion}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription-bottle-alt"></i></span> Detalles: ${producto.adicional}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-flask"></i></span> Laboratorio: ${producto.laboratorio}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-copyright"></i></span> Tipo: ${producto.tipo}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-pills"></i></span> Presentación: ${producto.presentacion}</li>
                        </ul>
                        </div>
                        <div class="col-5 text-center">
                        <img src="${producto.avatar}" alt="" class="img-circle img-fluid">
                        </div>
                    </div>
                    </div>
                    <div class="card-footer">
                    <div class="text-right">
                        <button class="avatar btn btn-sm bg-teal" type="button" data-toggle="modal" data-target="#cambio-logo">
                            <i class="fas fa-image"></i>
                        </button>
                        <button class="editar btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#crear-producto">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button class="lote btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#crear-lote">
                            <i class="fas fa-plus-square"></i>
                        </button>
                        <button class="borrar btn btn-sm btn-danger">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                    </div>
                </div>
                </div>
              `;

            });
            $('#productos').html(template);
        });
    }
    $(document).on('keyup','#buscar-producto',function(){
        let valor = $(this).val();
        if(valor != ""){
            buscarProducto(valor);
        }else{
            buscarProducto();
        }
    });
    $(document).on('click','.avatar',(e)=>{
        funcion = "cambiar_avatar";
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('prodId');
        const avatar = $(elemento).attr('prodAvatar');
        const nombre = $(elemento).attr('prodNombre');
        //Se envían los datos al form (modal)
        $('#funcion').val(funcion);
        $('#id-logo-prod').val(id);
        $('#avatar').val(avatar);
        $('#logo-actual').attr('src',avatar);
        $('#nombre-logo').html(nombre);
    });
    $('#form-logo').submit(e=>{
        let formData = new FormData($('#form-logo')[0]);
        $.ajax({
            url: '../controlador/ProductoControler.php',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false
        }).done(function(response){
            const json = JSON.parse(response);
            if(json.alert == 'edit'){
                $('#logo-actual').attr('src',json.ruta);
                $('#edit').hide('slow');
                $('#edit').show(1000).delay(3000);
                $('#edit').hide('slow');
                $('#form-logo').trigger('reset');
                buscarProducto();
            }else{
                $('#noedit').hide('slow');
                $('#noedit').show(1000).delay(3000);
                $('#noedit').hide('slow');
                $('#form-logo').trigger('reset');
            }
        });
        e.preventDefault();
    });
    //Botón editar de cada producto
    $(document).on('click','.editar',(e)=>{
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('prodId');
        const nombre = $(elemento).attr('prodNombre');
        const concentracion = $(elemento).attr('prodConcentracion');
        const adicional = $(elemento).attr('prodAdicional');
        const precio = $(elemento).attr('prodPrecio');
        const laboratorio = $(elemento).attr('prodLaboratorio');
        const tipo = $(elemento).attr('prodTipo');
        const presentacion = $(elemento).attr('prodPresentacion');
        
        //Se envían los datos al form (modal)
        $('#id-edit-prod').val(id);
        $('#nombre-producto').val(nombre);
        $('#concentracion').val(concentracion);
        $('#adicional').val(adicional);
        $('#precio').val(precio);
        $('#laboratorio').val(laboratorio).trigger('change');
        $('#tipo').val(tipo).trigger('change');
        $('#presentacion').val(presentacion).trigger('change');
        edit = true;
    });
    //Botón eliminar de cada producto
    $(document).on('click','.borrar',(e)=>{
        funcion = "eliminar";
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('prodID');
        const nombre = $(elemento).attr('prodNombre');
        const avatar = $(elemento).attr('prodAvatar');
        
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger mr-2'
            },
            buttonsStyling: false
          });
          
          swalWithBootstrapButtons.fire({
            title: '¿Desea eliminar '+nombre+'?',
            text: "¡No podrá revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '¡Sí, borrarlo!',
            cancelButtonText: '¡No, cancelar!',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
                $.post('../controlador/ProductoControler.php',{id,funcion},(response)=>{
                    edit = false;
                    if(response == 'borrado'){
                        swalWithBootstrapButtons.fire(
                            '¡Eliminado!',
                            'El producto '+nombre+' se ha eliminado.',
                            'success'
                        )
                        buscarProducto();
                    }else{
                        swalWithBootstrapButtons.fire(
                            '¡Ocurrió un error!',
                            'El producto '+nombre+' no se ha eliminado porque siendo usado en un lote.',
                            'error'
                        );
                    }
                });
              
            } else if (
              /* Read more about handling dismissals below */
              result.dismiss === Swal.DismissReason.cancel
            ) {
              swalWithBootstrapButtons.fire(
                'Cancelado',
                'El producto '+nombre+' no se ha eliminado.',
                'error'
              );
            }
          });
    });
    //Muestra el nombre de los productos en el modal
    $(document).on('click','.lote',(e)=>{
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('prodId');
        const nombre = $(elemento).attr('prodNombre');
        //Se envían los datos al form (modal)
        $('#id-lote-prod').val(id);
        $('#nombre-producto-lote').html(nombre);
    });
    //Envía los datos del form lote a LoteControler.php
    $('#form-crear-lote').submit(e=>{
        let id_producto = $('#id-lote-prod').val();
        let proveedor = $('#proveedor').val();
        let stock = $('#stock').val();
        let vencimiento = $('#vencimiento').val();
        funcion = "crear";
        //Peticion ajax que devuelve respuesta a la variable response
        $.post('../controlador/LoteControler.php',{funcion,vencimiento,stock,proveedor,id_producto},(response)=>{
            $('#added-lote').hide('slow');
            $('#added-lote').show(1000).delay(3000);
            $('#added-lote').hide('slow');
            $('#form-crear-lote').trigger('reset');
            buscarProducto();
        });
        e.preventDefault();
    });
});