$(document).ready(function(){
    var tipo_usuario = $('#tipo-usuario').val();
    if(tipo_usuario == 2){
        $('#boton-crear').hide();
    }
    BuscarDatos();
    var funcion;        
    function BuscarDatos(consulta){
        funcion = 'buscar_us';
        $.post('../controlador/UsuarioControler.php',{consulta,funcion},(response)=>{
            const usuarios = JSON.parse(response);
            let template = '';
            usuarios.forEach(usuario=>{
                template+=`
                    <div usuarioId="${usuario.id}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                    <div class="card bg-light">
                    <div class="card-header text-muted border-bottom-0">`;
                    if(usuario.tipo_usuario == 3){
                        template+=`<h1 class="badge badge-danger">${usuario.tipo}</h1>`;
                    }
                    if(usuario.tipo_usuario == 2){
                        template+=`<h1 class="badge badge-info">${usuario.tipo}</h1>`;
                    }
                    if(usuario.tipo_usuario == 1){
                        template+=`<h1 class="badge badge-warning">${usuario.tipo}</h1>`;
                    }    
                    template+=`</div>
                    <div class="card-body pt-0">
                        <div class="row">
                        <div class="col-7">
                            <h2 class="lead"><b>${usuario.nombre} ${usuario.apellidos}</b></h2>
                            <p class="text-muted text-sm"><b>Sobre mi: </b>${usuario.adicional}</p>
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-id-card"></i></span> NIT o No. identifiación: ${usuario.dni}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-birthday-cake"></i></span> Edad: ${usuario.edad}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Residencia: ${usuario.residencia}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Teléfono #: ${usuario.telefono}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span> E-mail: ${usuario.correo}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-smile-wink"></i></span> Sexo: ${usuario.sexo}</li>
                            </ul>
                        </div>
                        <div class="col-5 text-center">
                            <img src="${usuario.avatar}" alt="Avatar" class="img-circle img-fluid">
                        </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-right">`;
                        if(tipo_usuario == 3){
                            if(usuario.tipo_usuario != 3){
                                template+=`
                                <button class="eliminar-us btn btn-danger mr-1" type="button" data-toggle="modal" data-target="#confirmar">
                                    <i class="fas fa-window-close mr-1"></i>Elinimar
                                </button>
                                `;
                            }
                            if(usuario.tipo_usuario == 2){
                                template+=`
                                <button class="ascender btn btn-primary ml-1" type="button" data-toggle="modal" data-target="#confirmar">
                                    <i class="fas fa-sort-amount-up mr-1"></i>Ascender
                                </button>
                                `;
                            }
                            if(usuario.tipo_usuario == 1){
                                template+=`
                                <button class="descender btn btn-secondary ml-1" type="button" data-toggle="modal" data-target="#confirmar">
                                    <i class="fas fa-sort-amount-down mr-1"></i>Descender
                                </button>
                                `;
                            }
                        }else{
                            if(tipo_usuario == 1 && usuario.tipo_usuario != 1 && usuario.tipo_usuario != 3){
                                template+=`
                                <button class="eliminar-us btn btn-danger" type="button" data-toggle="modal" data-target="#confirmar">
                                    <i class="fas fa-window-close mr-1"></i>Elinimar
                                </button>
                                `;
                            }
                        }
                        template+=`
                        </div>
                    </div>
                    </div>
                </div>
                `;
            });
            $('#usuarios').html(template);
        });
    }
    $(document).on('keyup','#buscar',function(){
        let valor = $(this).val();
        if(valor != ""){
            BuscarDatos(valor);
        }else{
            BuscarDatos();
        }
    });
    $('#form-crear').submit(e=>{
        let nombre = $('#nombre').val();
        let apellido = $('#apellido').val();
        let edad = $('#edad').val();
        let dni = $('#dni').val();
        let pass = $('#pass').val();
        funcion = 'crear_usuario';
        $.post('../controlador/UsuarioControler.php',{nombre,apellido,edad,dni,pass,funcion},(response)=>{
            if(response == 'added'){
                $('#added').hide('slow');
                $('#added').show(1000).delay(3000);
                $('#added').hide('slow');
                $('#form-crear').trigger('reset');
                BuscarDatos();
            }else{
                $('#noadded').hide('slow');
                $('#noadded').show(1000).delay(3000);
                $('#noadded').hide('slow');
                $('#form-crear').trigger('reset');
            }
        });
        e.preventDefault();
    });
    $(document).on('click','.ascender',(e)=>{
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('usuarioId');
        funcion = 'ascender';
        $('#id-us').val(id);
        $('#funcion').val(funcion);
    });
    $(document).on('click','.descender',(e)=>{
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('usuarioId');
        funcion = 'descender';
        $('#id-us').val(id);
        $('#funcion').val(funcion);
    });
    $('#form-confirmar').submit(e=>{
        let pass = $('#old-pass').val();
        let id_usuario = $('#id-us').val();
        funcion = $('#funcion').val();
        $.post('../controlador/UsuarioControler.php',{pass,id_usuario,funcion},(response)=>{
            if(response == 'ascendido' || response == 'descendido' || response == 'eliminado'){
                $('#confirmado').hide('slow');
                $('#confirmado').show(1000).delay(3000);
                $('#confirmado').hide('slow');
                $('#form-confirmar').trigger('reset');
            }else{
                $('#rechazado').hide('slow');
                $('#rechazado').show(1000).delay(3000);
                $('#rechazado').hide('slow');
                $('#form-confirmar').trigger('reset');
            }
            BuscarDatos();
        });
        e.preventDefault();
    });
    $(document).on('click','.eliminar-us',(e)=>{
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('usuarioId');
        funcion = 'eliminar_usuario';
        $('#id-us').val(id);
        $('#funcion').val(funcion);
    });
});