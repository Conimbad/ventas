$(document).ready(function(){
    BuscarPres();
    var funcion;
    var bandera = false;

    $('#form-crear-pres').submit(e=>{
        let nombre_pres = $('#nombre-pres').val();
        let id_editado = $('#editar-pres').val();
        
        if(bandera == false){
            funcion = 'crear';
        }else{
            funcion = 'editar';
        }
        $.post('../controlador/PresentacionControler.php',{nombre_pres,id_editado,funcion},(response)=>{
            if(response == 'added'){
                $('#added-pres').hide('slow');
                $('#added-pres').show(1000).delay(3000);
                $('#added-pres').hide('slow');
                $('#form-crear-pres').trigger('reset');
                BuscarPres();  
            }
            if(response == 'noadded'){
                $('#noadded-pres').hide('slow');
                $('#noadded-pres').show(1000).delay(3000);
                $('#noadded-pres').hide('slow');
                $('#form-crear-pres').trigger('reset');
            }
            if(response == 'edit'){
                $('#edited-pres').hide('slow');
                $('#edited-pres').show(1000).delay(3000);
                $('#edited-pres').hide('slow');
                $('#form-crear-pres').trigger('reset');
                BuscarPres();  
            }
            bandera = false;
        });
        e.preventDefault();
    });
    function BuscarPres(consulta){
        funcion = 'buscar';
        $.post('../controlador/PresentacionControler.php',{consulta,funcion},(response)=>{
            const presentaciones = JSON.parse(response);
            let template = '';
            presentaciones.forEach(presentacion => {
                template += `
                    <tr presId="${presentacion.id}" presNombre="${presentacion.nombre}">
                        <td>${presentacion.nombre}</td>
                        <td>
                            <button class="editar-pres btn btn-success" title="Editar el presentación" type="button" data-toggle="modal" data-target="#crear-pres"><i class="fas fa-pencil-alt"></i></button>
                            <button class="eliminar-pres btn btn-danger" title="Eliminar presentación"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                `;
            });
            $('#presentaciones').html(template);
        });
    }
    $(document).on('keyup','#buscar-presentacion',function(){
        let valor = $(this).val();
        if(valor != ''){
            BuscarPres(valor);
        }else{
            BuscarPres();
        }
    });
    
    $(document).on('click','.eliminar-pres',(e)=>{
        funcion = "eliminar";
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('presId');
        const nombre = $(elemento).attr('presNombre');
        
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
                $.post('../controlador/PresentacionControler.php',{id,funcion},(response)=>{
                    bandera = false;
                    if(response == 'borrado'){
                        swalWithBootstrapButtons.fire(
                            '¡Eliminado!',
                            'La presentación '+nombre+' se ha eliminado.',
                            'success'
                        )
                        BuscarPres();
                    }else{
                        swalWithBootstrapButtons.fire(
                            '¡Ocurrió un error!',
                            'La presentación '+nombre+' no se ha eliminado porque existen productos de este.',
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
                'La presentación '+nombre+' no se ha eliminado.',
                'error'
              );
            }
          });
    });
    $(document).on('click','.editar-pres',(e)=>{
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('presId');
        const nombre = $(elemento).attr('presNombre');
        $('#editar-pres').val(id);
        $('#nombre-pres').val(nombre);
        bandera = true;
    });
});