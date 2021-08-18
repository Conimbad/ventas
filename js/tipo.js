$(document).ready(function(){
    BuscarTipo();
    var funcion;
    var bandera = false;

    $('#form-crear-tipo').submit(e=>{
        let nombre_tipo = $('#nombre-tipo').val();
        let id_editado = $('#editar-tipo').val();
        
        if(bandera == false){
            funcion = 'crear';
        }else{
            funcion = 'editar';
        }
        $.post('../controlador/TipoControler.php',{nombre_tipo,id_editado,funcion},(response)=>{
            if(response == 'added'){
                $('#added-tipo').hide('slow');
                $('#added-tipo').show(1000).delay(3000);
                $('#added-tipo').hide('slow');
                $('#form-crear-tipo').trigger('reset');
                BuscarTipo();  
            }
            if(response == 'noadded'){
                $('#noadded-tipo').hide('slow');
                $('#noadded-tipo').show(1000).delay(3000);
                $('#noadded-tipo').hide('slow');
                $('#form-crear-tipo').trigger('reset');
            }
            if(response == 'edit'){
                $('#edited-tipo').hide('slow');
                $('#edited-tipo').show(1000).delay(3000);
                $('#edited-tipo').hide('slow');
                $('#form-crear-tipo').trigger('reset');
                BuscarTipo();  
            }
            bandera = false;
        });
        e.preventDefault();
    });
    function BuscarTipo(consulta){
        funcion = 'buscar';
        $.post('../controlador/TipoControler.php',{consulta,funcion},(response)=>{
            const tipos = JSON.parse(response);
            let template = '';
            tipos.forEach(tipo => {
                template += `
                    <tr tipoId="${tipo.id}" tipoNombre="${tipo.nombre}">
                        <td>${tipo.nombre}</td>
                        <td>
                            <button class="editar-tipo btn btn-success" title="Editar tipo" type="button" data-toggle="modal" data-target="#crear-tipo"><i class="fas fa-pencil-alt"></i></button>
                            <button class="eliminar-tipo btn btn-danger" title="Eliminar tipo"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                `;
            });
            $('#tipos').html(template);
        });
    }
    $(document).on('keyup','#buscar-tipo',function(){
        let valor = $(this).val();
        if(valor != ''){
            BuscarTipo(valor);
        }else{
            BuscarTipo();
        }
    });
    
    $(document).on('click','.eliminar-tipo',(e)=>{
        funcion = "eliminar";
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('tipoId');
        const nombre = $(elemento).attr('tipoNombre');
        
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger mr-2'
            },
            buttonsStyling: false
          });
          
          swalWithBootstrapButtons.fire({
            title: '¿Desea eliminar a '+nombre+'?',
            text: "¡No podrá revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '¡Sí, borrarolo!',
            cancelButtonText: '¡No, cancelar!',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
                $.post('../controlador/TipoControler.php',{id,funcion},(response)=>{
                    bandera = false;
                    if(response == 'borrado'){
                        swalWithBootstrapButtons.fire(
                            '¡Eliminado!',
                            'El tipo '+nombre+' se ha eliminado.',
                            'success'
                        )
                        BuscarTipo();
                    }else{
                        swalWithBootstrapButtons.fire(
                            '¡Ocurrió un error!',
                            'El tipo '+nombre+' no ha eliminado porque existen productos de este.',
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
                'El tipo '+nombre+' no se ha eliminado.',
                'error'
              );
            }
          });
    });
    $(document).on('click','.editar-tipo',(e)=>{
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('tipoId');
        const nombre = $(elemento).attr('tipoNombre');
        $('#editar-tipo').val(id);
        $('#nombre-tipo').val(nombre);
        bandera = true;
    });
});