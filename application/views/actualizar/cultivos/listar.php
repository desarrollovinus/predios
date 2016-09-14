<link rel="stylesheet" href="<?php echo base_url(); ?>css/demo_table_jui.css" type="text/css" />
<?php $cultivos = $this->PrediosDAO->obtener_cultivos($ficha); ?>
<input type="button" value="Nuevo" id="nuevo" class="ui-button ui-widget ui-state-default ui-corner-all">
<input type="button" value="Volver" id="volver" class="ui-button ui-widget ui-state-default ui-corner-all">
<br><br>
<table id="tabla-cultivos" style="width:100%; font-size: 13px">
    <thead>
        <tr>
            <th>Nro</th>
            <th>Descripcion</th>
            <th>Cantidad</th>
            <th>Densidad</th>
            <th>Unidad</th>
            <th></th>
            <th hidden></th>
        </tr>
    </thead>
    <tbody>
        <?php $cont = 1 ?>
		<?php foreach ($cultivos as $cultivo): ?>
            <tr>
                <td><?= $cont ?></td>
                <td><?= $cultivo->descripcion ?></td>
                <td align='right'><?= floatval($cultivo->cantidad) ?></td>
                <td><?= $cultivo->densidad ?></td>
                <td><?= $cultivo->unidad ?></td>
                <td width="8%">
                    <a id="editar" onclick="javascript:editar(this)" style="cursor: pointer">
                        <img src="<?php echo base_url(); ?>img/edit.png" title="Editar cultivos">
                    </a>
                    <a onclick="javascript:eliminar_mensaje('<?= $cultivo->id_cultivo_especie ?>')" style="cursor: pointer">
                        <img src="<?php echo base_url(); ?>img/delete.png" title="Eliminar cultivos">
                    </a>
                </td>
                <td hidden><?= $cultivo->id_cultivo_especie ?></td>
                <?php $cont++; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div id="dialog-form" title="Nuevo cultivo" hidden>
    <div id="error"></div>
    <?= form_label('Descripción', 'descripcion') ?>
    <?php $data = array('name'=>'descripcion', 'value'=>'', 'style'=>'height:35%') ?>
    <?= form_textarea($data) ?>
    <?= form_label('Cantidad', 'cantidad') ?>
    <?php $data = array('name'=>'cantidad', 'value'=>'') ?>
    <?= form_input($data) ?>
    <?= form_label('Densidad', 'densidad') ?>
    <?php $data = array('name'=>'densidad', 'value'=>'') ?>
    <?= form_input($data) ?>
    <?= form_label('Unidad', 'unidad') ?>
    <?php $data = array('name'=>'unidad', 'value'=>'') ?>
    <?= form_input($data) ?>
    <input type="button" name="id_cultivo" value="" hidden>
    <input type="button" value="Cancelar" id="cancelar-nuevo" style="float:right;" class="ui-button ui-widget ui-state-default ui-corner-all">
    <input type="button" value="Guardar" id="guardar-nuevo" style="float:right;" class="ui-button ui-widget ui-state-default ui-corner-all">
</div>

<div id="dialog-confirm" title="Eliminar cultivo" hidden>
    ¿Esta seguro(a) de realizar esta acción?
</div>


<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#tabla-cultivos').dataTable({
        "bJQueryUI": true,
        "bSort": true,
        "sPaginationType": "full_numbers"
        // "aaSorting": [[ 2, "desc" ]]
    });
});

$('#volver').click(() => {
    location.reload();
});

$('#nuevo, #editar').click(() => {
    $( "#dialog-form" ).dialog({
        modal: true,
        height:300,
        width:700,
    });

    document.getElementsByClassName("ui-dialog-titlebar-close")[0].addEventListener("click", () => {
        $('input[type=text]').val('');
        $('textarea').val('');
    });
    $("#error").empty();
});

$('#guardar-nuevo').click(() => {
    var id = $("input[name=id_cultivo]").val();
    var descripcion = $("textarea[name=descripcion]");
    var cantidad = $("input[name=cantidad]");
    var densidad = $("input[name=densidad]");
    var unidad = $("input[name=unidad]");
    var datos = {
        "ficha_predial": "<?= $ficha ?>",
		"descripcion": descripcion.val(),
        "cantidad": cantidad.val(),
        "densidad": densidad.val(),
        "unidad": unidad.val()
    };
    if (datos.descripcion === '' || datos.cantidad === '' || datos.unidad === '') {
        // Mensaje de advertencia
        $("#error").html('<div id="alerta" class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0px 0.7em;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>Llene los campos obligatorios</p></div>');
        return false;
    } // if
    if (id === '') {
        $.ajax({
            url: "<?php echo site_url('actualizar_controller/insertar_cultivo'); ?>",
            data: {"ficha": datos.ficha, "datos": datos},
            type: "POST",
            dataType: "html",
            async: false,
            success: function(respuesta){
                //Si la respuesta no es error
                if(respuesta){
                    //Se almacena la respuesta como variable de éxito
                    return respuesta;
                }
            },//Success
            error: function(respuesta){
                //Variable de exito será mensaje de error de ajax
                return respuesta;
            }//Error
        });//Ajax
    } else {
        if (datos.descripcion === '' || datos.cantidad === '' || datos.unidad === '') {
            // Mensaje de advertencia
            $("#error").html('<div id="alerta" class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0px 0.7em;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>Llene los campos obligatorios</p></div>');
            return false;
        } // if

        $.ajax({
            url: "<?php echo site_url('actualizar_controller/editar_cultivo'); ?>",
            data: {"id": id, "datos": datos},
            type: "POST",
            dataType: "html",
            async: false,
            success: function(respuesta){
                //Si la respuesta no es error
                if(respuesta){
                    //Se almacena la respuesta como variable de éxito
                    return respuesta;
                }
            },//Success
            error: function(respuesta){
                //Variable de exito será mensaje de error de ajax
                return respuesta;
            }//Error
        });//Ajax
    } // else
    $('#dialog-form').remove();
    $("#dialog-form").dialog("close");
    listar();
}); // Evento click guardar-nuevo

$('#cancelar-nuevo').click(() => {
    $("#dialog-form").dialog("close");
    $('input[type=text]').val('');
    $('textarea').val('');
});

function editar(fila) {
    fila = fila.parentElement.parentElement.cells;
    $("textarea[name=descripcion]").val(fila[1].innerHTML);
    $("input[name=cantidad]").val(fila[2].innerHTML);
    $("input[name=densidad]").val(fila[3].innerHTML);
    $("input[name=unidad]").val(fila[4].innerHTML);
    $("input[name=id_cultivo]").val(fila[6].innerHTML);
    $("#error").empty();
}

function eliminar_cultivo(id) {
    $.ajax({
        url: "<?php echo site_url('actualizar_controller/eliminar_cultivo'); ?>",
        data: {"id": id},
        type: "POST",
        dataType: "html",
        async: false,
        success: function(respuesta){
            //Si la respuesta no es error
            if(respuesta){
                //Se almacena la respuesta como variable de éxito
                return respuesta;
            }
        },//Success
        error: function(respuesta){
            //Variable de exito será mensaje de error de ajax
            return respuesta;
        }//Error
    });//Ajax
    listar();
}

function eliminar_mensaje(id) {

    $( "#dialog-confirm" ).dialog({
        resizable: false,
        height:200,
        width:420,
        modal: true,
        buttons: {
            Si: function() {
                eliminar_cultivo(id);
                //se destruye el elemento dialog
                $( "#dialog:ui-dialog" ).dialog( "destroy" );
                //se remueve el div con id="dialog-confirm" del documento html
                $('#dialog-confirm').remove();
                //se cierra el elemento flotante
                $( this ).dialog( "close" );
            },
            No: function() {
                //se cierra el elemento flotante
                $( this ).dialog( "close" );
            }
        }
    });
}
</script>
