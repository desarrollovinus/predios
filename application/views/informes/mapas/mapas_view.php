<style media="screen">
    .wrap {
    width: 100%;
    display: table;
    }
    .wrap-center {
    width: 700px;
    margin: 0 auto;
    }
    .input-content {
    display: inline-block;
    width: 19.5%;
    }
    .content-button {
    text-align: center;
    }

    .content-button a {
        font-size: 1.2em;
        padding: 10px 20px;
        border-radius: 5px;
        display: inline-block;
        margin-top: 30px;
    }
</style>

<h1 align='center'>Seleccione una o varias unidades funcionales para visualizar en el mapa</h1>

<div class='wrap'>
    <div class="input-content">
        <?= form_label('UF1', 'UF1')?>
        <?= form_checkbox('UF1', '1')?>
    </div>

    <div class="input-content">
        <?= form_label('UF2', 'UF2')?>
        <?= form_checkbox('UF2', '2')?>
    </div>

    <div class="input-content">
        <?= form_label('UF3', 'UF3')?>
        <?= form_checkbox('UF3', '3')?>
    </div>

    <div class="input-content">
        <?= form_label('UF4', 'UF4')?>
        <?= form_checkbox('UF4', '4')?>
    </div>

    <div class="input-content">
        <?= form_label('UF5', 'UF5')?>
        <?= form_checkbox('UF5', '5')?>
    </div>

    <center>
        <div class='content-button'>
            <a class='ui-button ui-widget ui-state-default ui-corner-all' href="#" id="kml">Generar Mapa</a>
        </div>
    <center>
</div>

<div id="error"></div>

<script type="text/javascript">
$("input:checkbox").click(() => {
    var checks = $( "input:checked" );
    var url = "<?= site_url('archivos_controller/generar_kml')?>";
    url += '/';
    for (let i = 0; i < checks.length; i++) {
        if (i === 0) {
            url += checks[i].value;
        } else {
            url += '.' + checks[i].value;
        }
    }
    $("#kml").attr( 'href', url );
});

$("#kml").mouseover(()=> {
    var checks = $( "input:checked" );
    if (checks.length === 0) {
        $("#kml").attr( 'href', '#');
    }
});

$("#kml").click(() => {
    var checks = $( "input:checked" );
    if (checks.length === 0) {
        $("#error").html('<div id="alerta" class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0px 0.7em;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>Debe seleccionar al menos una unidad funcional</p></div>');
    } else {
        $( "#alerta" ).remove();
    }
});
</script>
