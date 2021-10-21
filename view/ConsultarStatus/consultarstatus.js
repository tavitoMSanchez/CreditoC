var IdUsuario = $("#useridx").val();
var usu_admon = $("#useradmon").val();

function init(){
console.log(usu_admon);

    var x = document.getElementById("myDIV");
	
	
    if (usu_admon == 1) {
		x.style.visibility = "initial" ;
		console.log("entranone");
		
    } else
    {
        x.style.display = "none" ;
    }

    $.post("../../controller/clienteEstatus.php?op=combo",function(data, status){
        $('#valselect2').html(data);
     
    });
    $.post("../../controller/clienteEstatus.php?op=combousuarios",function(data2, status){
        $('#selectUsuario').html(data2);
    });    

    $("#formObservacion").on("submit",function(e){
       
        guardaryeditar(e);
        
    });

       
}

$(document).ready(function(){
    tabla= $('#partes_data').DataTable({
        "aProcessing": true,//Activamos el procesamiento del datatables
        "aServerSide": true,//Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip',//Definimos los elementos del control de tabla
        "ajax":{
        url:"../../controller/partes.php?op=listar",
        type : "post",
        data:{IdUsuario:IdUsuario,usu_admon:usu_admon},						
            error: function(e){
                console.log(e.responseText);
            },
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 10,
        "order": [[ 0, "desc" ]],
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {          
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
    });
});


function guardaryeditar(e){


 
     e.preventDefault();
   
	 var formData = new FormData($("#formObservacion")[0]);
   
     $.ajax({
         url: "../../controller/partes.php?op=guardaryeditar",
         type: "POST",
         data: formData,
         contentType: false,
         processData: false,
         success: function(datos){    
            
             $('#formObservacion')[0].reset();
             $("#modaldetalle").modal('hide');
             $('#partes_data').DataTable().ajax.reload();	
             Swal.fire('Guardado!','Registro Actualizado Correctamente.','success')
         }
     }); 
}


function editar(IdCliente){
   
    $.post("../../controller/partes.php?op=mostrar",{IdCliente : IdCliente}, function(data, status){
        data = JSON.parse(data);
      
       
        //$('#titulo_crud').html('CRUD-Editar Registro');
        $('#valselect2').val(data.IdEstatusCliente);
        
        
        
            $('#selectUsuario').val(data.IdUsuario);
      
         $('#Observacion').val(data.Observacion);
         $('#IdClienteSeleccionado').val(data.IdCliente);
     
    }); 
    $("#modalcrud").modal('show');	
}

function ver(IdCliente){
    // llenartabla(IdProspecto);
  
    editar(IdCliente);
 
    $("#modaldetalle").modal("show");

 
    
    // $("#val-select2").change(function(){
    //     $("#val-select2 option:selected").each(function () {
    //         part_id = $(this).val();
     
    //         console.log(part_id);
    //     });
    // });
}



// function llenartabla(IdProspecto){
//     tabla= $('#detalle_data').DataTable({
//         "aProcessing": true,//Activamos el procesamiento del datatables
//         "aServerSide": true,//Paginación y filtrado realizados por el servidor
//         dom: 'Bfrtip',//Definimos los elementos del control de tabla
//         "ajax":{
//         url:"../../controller/partes.php?op=listardetalle_consulta",
//         type : "post",
//         data:{IdProspecto:IdProspecto},						
//             error: function(e){
//                 console.log(e.responseText);
//             },
//         },
//         "bDestroy": true,
//         "responsive": true,
//         "bInfo":true,
//         "iDisplayLength": 10,
//         "order": [[ 0, "desc" ]],
//         "language": {
//             "sProcessing":     "Procesando...",
//             "sLengthMenu":     "Mostrar _MENU_ registros",
//             "sZeroRecords":    "No se encontraron resultados",
//             "sEmptyTable":     "Ningún dato disponible en esta tabla",
//             "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
//             "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
//             "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
//             "sInfoPostFix":    "",
//             "sSearch":         "Buscar:",
//             "sUrl":            "",
//             "sInfoThousands":  ",",
//             "sLoadingRecords": "Cargando...",
//             "oPaginate": {          
//                 "sFirst":    "Primero",
//                 "sLast":     "Último",
//                 "sNext":     "Siguiente",
//                 "sPrevious": "Anterior"
//             },
//             "oAria": {
//                 "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
//                 "sSortDescending": ": Activar para ordenar la columna de manera descendente"
//             }
//         },
//     });


    

// }

init();