$(document).ready(function(){
    var funcion;
    var edit = false;
    $('.select2').select2();
    buscarLote();//Hace una búsqueda de los lotes al iniciar la página
    //Busca los lotes y los muestra sin actualizar la página
    function buscarLote(consulta){
        funcion = "buscar";
        $.post('../controlador/LoteControler.php',{consulta,funcion},(response)=>{
            const lotes = JSON.parse(response);
            let template = '';
            lotes.forEach(lote =>{
                //Template de los cards donde se muestran los lotes y sus especificaciones
                template += `
                <div loteId="${lote.id}" loteStock="${lote.stock}"class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">`;
                if(lote.estado == 'light'){
                    template += `<div class="card bg-light">`;
                }
                if(lote.estado == 'danger'){
                    template += `<div class="card bg-danger">`;
                }
                if(lote.estado == 'warning'){
                    template += `<div class="card bg-warning">`;
                }
                template += `<div class="card-header border-bottom-0">
                <h6>Código ${lote.id}</h6>
                        <i class="fas fa-lg fa-cubes mr-1"></i>${lote.stock}
                    </div>
                    <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-7">
                        <h2 class="lead"><b>${lote.nombre}</b></h2>                       
                        <ul class="ml-4 mb-0 fa-ul">
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span> Concentración: ${lote.concentracion}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription-bottle-alt"></i></span> Detalles: ${lote.adicional}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-flask"></i></span> Laboratorio: ${lote.laboratorio}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-copyright"></i></span> Tipo: ${lote.tipo}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-pills"></i></span> Presentación: ${lote.presentacion}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar-times"></i></span> Vencimiento: ${lote.vencimiento}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-truck"></i></span> Proveedor: ${lote.proveedor}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar-alt"></i></span> Mes: ${lote.mes}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar-day"></i></span> Día: ${lote.dia}</li>
                        </ul>
                        </div>
                        <div class="col-5 text-center">
                        <img src="${lote.avatar}" alt="" class="img-circle img-fluid">
                        </div>
                    </div>
                    </div>
                    <div class="card-footer">
                    <div class="text-right">
                        <button class="editar btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#editar-lote">
                            <i class="fas fa-pencil-alt"></i>
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
            $('#lotes').html(template);
        });
    }
    $(document).on('keyup','#buscar-lote',function(){
        let valor = $(this).val();
        if(valor != ""){
            buscarLote(valor);
        }else{
            buscarLote();
        }
    });
    $(document).on('click','.editar',(e)=>{
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('loteId');
        const stock = $(elemento).attr('loteStock');
        //Se envían los datos al form (modal)
        $('#id-lote-prod').val(id);
        $('#stock').val(stock);
        $('#codigo-lote').html(id);
    });
    $('#form-editar-lote').submit(e=>{
        let id = $('#id-lote-prod').val();
        let stock = $('#stock').val();
        funcion = "editar";
        $.post('../controlador/LoteControler.php',{id,stock,funcion},(response)=>{
            if(response == 'edited'){
                $('#edited-lote').hide('slow');
                $('#edited-lote').show(1000).delay(3000);
                $('#edited-lote').hide('slow');
                $('#form-editar-lote').trigger('reset');
            }
            buscarLote();
        });
        e.preventDefault();
    });
    $(document).on('click','.borrar',(e)=>{
        funcion = "eliminar";
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('loteID');
        
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger mr-2'
            },
            buttonsStyling: false
          });
          
          swalWithBootstrapButtons.fire({
            title: '¿Desea eliminar el lote '+id+'?',
            text: "¡No podrá revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '¡Sí, borrarlo!',
            cancelButtonText: '¡No, cancelar!',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
                $.post('../controlador/LoteControler.php',{id,funcion},(response)=>{
                    if(response == 'borrado'){
                        swalWithBootstrapButtons.fire(
                            '¡Eliminado!',
                            'El lote '+id+' se ha eliminado.',
                            'success'
                        )
                        buscarLote();
                    }else{
                        swalWithBootstrapButtons.fire(
                            '¡Ocurrió un error!',
                            'El lote '+id+' no se ha eliminado porque está siendo usado.',
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
                'El lote '+id+' no se ha eliminado.',
                'error'
              );
            }
          });
    });
});