$(document).ready(function(){
    BuscarLab();
    var funcion;
    var bandera = false;

    $('#form-crear-lab').submit(e=>{
        let nombre_lab = $('#nombre-laboratorio').val();
        let id_editado = $('#editar-lab').val();
        
        if(bandera == false){
            funcion = 'crear';
        }else{
            funcion = 'editar';
        }
        $.post('../controlador/LaboratorioControler.php',{nombre_lab,id_editado,funcion},(response)=>{
            if(response == 'added'){
                $('#added-lab').hide('slow');
                $('#added-lab').show(1000).delay(3000);
                $('#added-lab').hide('slow');
                $('#form-crear-lab').trigger('reset');
                BuscarLab();  
            }
            if(response == 'noadded'){
                $('#noadded-lab').hide('slow');
                $('#noadded-lab').show(1000).delay(3000);
                $('#noadded-lab').hide('slow');
                $('#form-crear-lab').trigger('reset');
            }
            if(response == 'edit'){
                $('#edited-lab').hide('slow');
                $('#edited-lab').show(1000).delay(3000);
                $('#edited-lab').hide('slow');
                $('#form-crear-lab').trigger('reset');
                BuscarLab();  
            }
            bandera = false;
        });
        e.preventDefault();
    });
    function BuscarLab(consulta){
        funcion = 'buscar';
        $.post('../controlador/LaboratorioControler.php',{consulta,funcion},(response)=>{
            const laboratorios = JSON.parse(response);
            let template = '';
            laboratorios.forEach(laboratorio => {
                template += `
                    <tr labId="${laboratorio.id}" labNombre="${laboratorio.nombre}" labAvatar="${laboratorio.avatar}">
                        <td>${laboratorio.nombre}</td>
                        <td>
                            <img src="${laboratorio.avatar}" class="img-fluid rounded" width="70" heigth="70">
                        </td>
                        <td>
                            <button class="avatar btn btn-info" title="Cambiar logo de laboratorio" type="button" data-toggle="modal" data-target="#cambio-logo"><i class="far fa-image"></i></button>
                            <button class="editar btn btn-success" title="Editar el laboratorio" type="button" data-toggle="modal" data-target="#crear-lab"><i class="fas fa-pencil-alt"></i></button>
                            <button class="eliminar btn btn-danger" title="Eliminar laboratorio"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                `;
            });
            $('#laboratorios').html(template);
        });
    }
    $(document).on('keyup','#buscar-laboratorio',function(){
        let valor = $(this).val();
        if(valor != ''){
            BuscarLab(valor);
        }else{
            BuscarLab();
        }
    });
    $(document).on('click','.avatar',(e)=>{
        funcion = "cambiar_logo";
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('labId');
        const nombre = $(elemento).attr('labNombre');
        const avatar = $(elemento).attr('labAvatar');
        $('#logo-actual').attr('src',avatar);
        $('#nombre-logo').html(nombre);
        $('#funcion').val(funcion);
        $('#id-logo-lab').val(id);
    });
    $('#form-logo').submit(e=>{
        let formData = new FormData($('#form-logo')[0]);
        $.ajax({
            url:'../controlador/LaboratorioControler.php',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false
        }).done(function (response) {
            const json = JSON.parse(response);
            if(json.alert == 'edit'){
                $('#logo-actual').attr('src',json.ruta);
                $('#form-logo').trigger('reset');

                $('#avatar_1').attr('src',json.ruta);
                $('#edit').hide('slow');
                $('#edit').show(1000).delay(3000);
                $('#edit').hide('slow');
                BuscarLab();
            }else{
                $('#avatar_1').attr('src',json.ruta);
                $('#no-edit').hide('slow');
                $('#no-edit').show(1000).delay(3000);
                $('#no-edit').hide('slow');
                $('#form-logo').trigger('reset');
            }
        });
        e.preventDefault();
    });
    $(document).on('click','.eliminar',(e)=>{
        funcion = "eliminar";
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('labId');
        const nombre = $(elemento).attr('labNombre');
        const avatar = $(elemento).attr('labAvatar');
        
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
            confirmButtonText: '¡Sí, borrarlo!',
            cancelButtonText: '¡No, cancelar!',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
                $.post('../controlador/LaboratorioControler.php',{id,funcion},(response)=>{
                    bandera = false;
                    if(response == 'borrado'){
                        swalWithBootstrapButtons.fire(
                            '¡Eliminado!',
                            'El proveedor '+nombre+' se ha eliminado.',
                            'success'
                        )
                        BuscarLab();
                    }else{
                        swalWithBootstrapButtons.fire(
                            '¡Ocurrió un error!',
                            'El proveedor '+nombre+' no ha eliminado porque existen productos de este.',
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
    $(document).on('click','.editar',(e)=>{
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('labId');
        const nombre = $(elemento).attr('labNombre');
        $('#editar-lab').val(id);
        $('#nombre-laboratorio').val(nombre);
        bandera = true;
    });
});