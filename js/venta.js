$(document).ready(function(){
    mostrarConsultas();
    function mostrarConsultas(){
        let funcion = "mostrar_consultas";
        $.post('../controlador/VentaControler.php',{funcion},(response)=>{
            const vistas = JSON.parse(response);
            $('#venta-dia-vendedor').html(vistas.venta_dia_vendedor);
            $('#venta-diaria').html(vistas.venta_diaria);
            $('#venta-mensual').html(vistas.venta_mensual);
            $('#venta-anual').html(vistas.venta_anual);
        })
    }

    funcion = "listar";
    //Mostrando los datos en datatable
    let datatable = $('#tabla-venta').DataTable( {
        "ajax": {
            "url": "../controlador/VentaControler.php",
            "method": "POST",
            "data": {funcion:funcion}
        },
        "columns": [
            { "data": "id_venta" },
            { "data": "fecha" },
            { "data": "cliente" },
            { "data": "dni" },
            { "data": "total" },
            { "data": "vendedor" },
            { "defaultContent": `<button class="imprimir btn btn-secondary"> <i class="fa fa-print"></i> </button>
                                <button class="ver btn btn-success type="button" data-toggle="modal" data-target="#vista-venta"> <i class="fa fa-search"></i> </button>
                                <button class="borrar btn btn-danger"> <i class="fa fa-window-close"></i> </button>` }
        ],
        "language": espanol
    });
    //Botón imprimir
    $('#tabla-venta tbody').on('click','.imprimir',function(){
        let datos = datatable.row($(this).parents()).data();
        let id = datos.id_venta;
        $.post('../controlador/PDFControler.php',{id},(response)=>{
            console.log(response);
            window.open('../pdf/pdf-'+id+'.pdf','_blank');
        });
    });
    //Alerta para eliminar una venta
    $('#tabla-venta tbody').on('click','.borrar',function(){
        let datos = datatable.row($(this).parents()).data();
        let id = datos.id_venta;
        funcion = "borrar_venta";
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success m-1',
              cancelButton: 'btn btn-danger m-1'
            },
            buttonsStyling: false
          })
          
          swalWithBootstrapButtons.fire({
            title: '¿Está seguro que desea eliminar la venta: '+id+'?',
            text: "No podrá revertir esta acción",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '¡Sí, borrarlo!',
            cancelButtonText: '¡No, cancelar!',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
                $.post('../controlador/DetalleVentaControler.php',{funcion,id},(response)=>{
                    if(response == 'deleted'){
                        swalWithBootstrapButtons.fire(
                            '¡Eliminado!',
                            'La venta ha sido eliminada.',
                            'success'
                        );
                    }else if(response == 'nodeleted'){
                        swalWithBootstrapButtons.fire(
                            'Cancelado',
                            'No tiene los privilegios suficientes para realizar esta acción',
                            'error'
                          )
                    }
                })
              
            } else if (
              /* Read more about handling dismissals below */
              result.dismiss === Swal.DismissReason.cancel
            ) {
              swalWithBootstrapButtons.fire(
                'Cancelado',
                'La venta está a salvo :)',
                'error'
              )
            }
          })
    
    });
    //Se envían los datos al modal 
    $('#tabla-venta tbody').on('click','.ver',function(){
        let datos = datatable.row($(this).parents()).data();
        let id = datos.id_venta;
        funcion = "ver";
        $('#codigo-venta').html(datos.id_venta);
        $('#fecha').html(datos.fecha);
        $('#cliente').html(datos.cliente);
        $('#nit').html(datos.dni);
        $('#vendedor').html(datos.vendedor);
        $('#total').html(datos.total);
        $.post('../controlador/VentaProductoControler.php',{funcion,id},(response)=>{
            let registros = JSON.parse(response);
            let template = '';
            $('#registros').html(template);
            registros.forEach(registro => {
                template += `
                    <tr>
                        <td>${registro.cantidad}</td>
                        <td>${registro.precio}</td>
                        <td>${registro.producto}</td>
                        <td>${registro.concentracion}</td>
                        <td>${registro.adicional}</td>
                        <td>${registro.laboratorio}</td>
                        <td>${registro.presentacion}</td>
                        <td>${registro.tipo}</td>
                        <td>${registro.subtotal}</td>
                    </tr>
                `;
                $('#registros').html(template);
            });
        })
    });
});

//Varible a la que se le asigna un arreglo para cambiar el idioma de la tabla
let espanol = {
    "processing": "Procesando...",
    "lengthMenu": "Mostrar _MENU_ registros",
    "zeroRecords": "No se encontraron resultados",
    "emptyTable": "Ningún dato disponible en esta tabla",
    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
    "search": "Buscar:",
    "infoThousands": ",",
    "loadingRecords": "Cargando...",
    "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": "Siguiente",
        "previous": "Anterior"
    },
    "aria": {
        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad",
        "collection": "Colección",
        "colvisRestore": "Restaurar visibilidad",
        "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
        "copySuccess": {
            "1": "Copiada 1 fila al portapapeles",
            "_": "Copiadas %d fila al portapapeles"
        },
        "copyTitle": "Copiar al portapapeles",
        "csv": "CSV",
        "excel": "Excel",
        "pageLength": {
            "-1": "Mostrar todas las filas",
            "1": "Mostrar 1 fila",
            "_": "Mostrar %d filas"
        },
        "pdf": "PDF",
        "print": "Imprimir"
    },
    "autoFill": {
        "cancel": "Cancelar",
        "fill": "Rellene todas las celdas con <i>%d<\/i>",
        "fillHorizontal": "Rellenar celdas horizontalmente",
        "fillVertical": "Rellenar celdas verticalmentemente"
    },
    "decimal": ",",
    "searchBuilder": {
        "add": "Añadir condición",
        "button": {
            "0": "Constructor de búsqueda",
            "_": "Constructor de búsqueda (%d)"
        },
        "clearAll": "Borrar todo",
        "condition": "Condición",
        "conditions": {
            "date": {
                "after": "Despues",
                "before": "Antes",
                "between": "Entre",
                "empty": "Vacío",
                "equals": "Igual a",
                "not": "No",
                "notBetween": "No entre",
                "notEmpty": "No Vacio"
            },
            "moment": {
                "after": "Despues",
                "before": "Antes",
                "between": "Entre",
                "empty": "Vacío",
                "equals": "Igual a",
                "not": "No",
                "notBetween": "No entre",
                "notEmpty": "No vacio"
            },
            "number": {
                "between": "Entre",
                "empty": "Vacio",
                "equals": "Igual a",
                "gt": "Mayor a",
                "gte": "Mayor o igual a",
                "lt": "Menor que",
                "lte": "Menor o igual que",
                "not": "No",
                "notBetween": "No entre",
                "notEmpty": "No vacío"
            },
            "string": {
                "contains": "Contiene",
                "empty": "Vacío",
                "endsWith": "Termina en",
                "equals": "Igual a",
                "not": "No",
                "notEmpty": "No Vacio",
                "startsWith": "Empieza con"
            }
        },
        "data": "Data",
        "deleteTitle": "Eliminar regla de filtrado",
        "leftTitle": "Criterios anulados",
        "logicAnd": "Y",
        "logicOr": "O",
        "rightTitle": "Criterios de sangría",
        "title": {
            "0": "Constructor de búsqueda",
            "_": "Constructor de búsqueda (%d)"
        },
        "value": "Valor"
    },
    "searchPanes": {
        "clearMessage": "Borrar todo",
        "collapse": {
            "0": "Paneles de búsqueda",
            "_": "Paneles de búsqueda (%d)"
        },
        "count": "{total}",
        "countFiltered": "{shown} ({total})",
        "emptyPanes": "Sin paneles de búsqueda",
        "loadMessage": "Cargando paneles de búsqueda",
        "title": "Filtros Activos - %d"
    },
    "select": {
        "1": "%d fila seleccionada",
        "_": "%d filas seleccionadas",
        "cells": {
            "1": "1 celda seleccionada",
            "_": "$d celdas seleccionadas"
        },
        "columns": {
            "1": "1 columna seleccionada",
            "_": "%d columnas seleccionadas"
        }
    },
    "thousands": "."
};