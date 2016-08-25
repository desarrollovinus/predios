
<?= form_label('UF1', 'UF1')?>
<?= form_checkbox('UF1', '1')?>

<?= form_label('UF2', 'UF2')?>
<?= form_checkbox('UF2', '2')?>

<?= form_label('UF3', 'UF3')?>
<?= form_checkbox('UF3', '3')?>

<?= form_label('UF4', 'UF4')?>
<?= form_checkbox('UF4', '4')?>

<?= form_label('UF5', 'UF5')?>
<?= form_checkbox('UF5', '5')?>

<a href="#" id="kml">Generar kml</a>

<div id="error"></div>

<script type="text/javascript">
$("input:checkbox").click(() => {
    var checks = $( "input:checked" );
    var url = "<?= site_url('archivos_controller/generar_kml_unidades_funcionales')?>";
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
