$(document).ready(function(){
    var edit = false;
    var funcion;
    buscarProv();
    $('#form-crear').submit(e=>{
        let id = $('#id-edit-prov').val();
        let nombre = $('#nombre').val();
        let telefono = $('#telefono').val();
        let correo = $('#correo').val();
        let direccion = $('#direccion').val();

        if(edit == true){
            funcion = 'editar';
        }else{
            funcion = 'crear';
        }
        $.post('../controlador/ProveedorControler.php',{id,nombre,telefono,correo,direccion,funcion},(response)=>{
            console.log(response);
            if(response == 'added'){
                $('#added-prov').hide('slow');
                $('#added-prov').show(1000).delay(3000);
                $('#added-prov').hide('slow');
                $('#form-crear').trigger('reset');
                buscarProv(); 
            }
            if(response == 'noadded' || response == 'noedit'){
                $('#noadded-prov').hide('slow');
                $('#noadded-prov').show(1000).delay(3000);
                $('#noadded-prov').hide('slow');
                $('#form-crear').trigger('reset');
            }
            if(response == 'edit'){
                $('#edited-prov').hide('slow');
                $('#edited-prov').show(1000).delay(3000);
                $('#edited-prov').hide('slow');
                $('#form-crear').trigger('reset');
                buscarProv();
            }
            edit = false;
        });
        e.preventDefault();
    });
    function buscarProv(consulta){
        funcion = 'buscar';
        $.post('../controlador/ProveedorControler.php',{consulta,funcion},(response)=>{
            const proveedores = JSON.parse(response);
            let template ='';
            proveedores.forEach(proveedor=>{ 
                template += `
                <div provId="${proveedor.id}" provNombre="${proveedor.nombre}" provTelefono="${proveedor.telefono}" 
                provCorreo="${proveedor.correo}" provDireccion="${proveedor.direccion}" provAvatar="${proveedor.avatar}" 
                class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                    <div class="card bg-light">
                    <div class="card-header text-muted border-bottom-0">
                        <h1 class="badge badge-success">Proveedor</h1>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                        <div class="col-7">
                            <h2 class="lead"><b>${proveedor.nombre}</b></h2>
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Dirección: ${proveedor.direccion}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Teléfono #: ${proveedor.telefono}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span> correo: ${proveedor.correo}</li>
                            </ul>
                        </div>
                        <div class="col-5 text-center">
                            <img src="${proveedor.avatar}" alt="" class="img-circle img-fluid">
                        </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                        <button class=" avatar btn btn-sm bg-teal" title="Editar logo" type="button" 
                        data-toggle="modal" data-target="#cambio-logo">
                            <i class="fas fa-image"></i>
                        </button>
                        <button class=" editar btn btn-sm bg-success" title="Editar proveedor" type="button" 
                        data-toggle="modal" data-target="#crear-proveedor">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button class=" borrar btn btn-sm bg-danger" title="Eliminar proveedor">
                            <i class="fas fa-trash"></i>
                        </button>
                        </div>
                    </div>
                    </div>
                </div>
                `; 
            });
            $('#proveedores').html(template);
        });
    }
    $(document).on('keyup','#buscar-proveedor',function(){
        let valor = $(this).val();
        if(valor != ''){
            buscarProv(valor);
        }else{
            buscarProv();
        }
    });
    $(document).on('click','.avatar',(e)=>{
        funcion = 'cambiar_logo';
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('provId');
        const nombre = $(elemento).attr('provNombre');
        const avatar = $(elemento).attr('provAvatar');
        $('#logo-actual').attr('src',avatar);
        $('#nombre-logo').html(nombre);
        $('#id-logo-prov').val(id);
        $('#funcion').val(funcion);
        $('#avatar').val(avatar);
    });
    //Editar /////
    $(document).on('click','.editar',(e)=>{
        funcion = 'cambiar_logo';
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('provId');
        const nombre = $(elemento).attr('provNombre');
        const direccion = $(elemento).attr('provDireccion');
        const telefono = $(elemento).attr('provTelefono');
        const correo = $(elemento).attr('provCorreo');
        $('#id-edit-prov').val(id);
        $('#nombre').val(nombre);
        $('#direccion').val(direccion);
        $('#telefono').val(telefono);
        $('#correo').val(correo);
        edit = true;
    });
    $('#form-logo').submit(e=>{
        let formData = new FormData($('#form-logo')[0]);
        $.ajax({
            url: '../controlador/ProveedorControler.php',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false
        }).done(function(response){
            const json = JSON.parse(response);
            if(json.alert == 'edit'){
                $('#logo-actual').attr('src',json.ruta);
                $('#edit-prov').hide('slow');
                $('#edit-prov').show(1000).delay(3000);
                $('#edit-prov').hide('slow');
                $('#form-logo').trigger('reset');
                buscarProv();
            }else{
                $('#no-edit-prov').hide('slow');
                $('#no-edit-prov').show(1000).delay(3000);
                $('#no-edit-prov').hide('slow');
                $('#form-logo').trigger('reset');
            }
        });
        e.preventDefault();
    });
    //Botón eliminar de cada producto
    $(document).on('click','.borrar',(e)=>{
        funcion = "eliminar";
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('provID');
        const nombre = $(elemento).attr('provNombre');
        const avatar = $(elemento).attr('provAvatar');
        
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
                $.post('../controlador/ProveedorControler.php',{id,funcion},(response)=>{
                    edit = false;
                    if(response == 'borrado'){
                        swalWithBootstrapButtons.fire(
                            '¡Eliminado!',
                            'El proveedor '+nombre+' se ha eliminado.',
                            'success'
                        )
                        buscarProv();
                    }else{
                        swalWithBootstrapButtons.fire(
                            '¡Ocurrió un error!',
                            'El proveedor '+nombre+' no se ha eliminado porque siendo usado en un lote.',
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
                'El proveedor '+nombre+' no se ha eliminado.',
                'error'
              );
            }
          });
    });
});

