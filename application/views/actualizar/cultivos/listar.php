<link rel="stylesheet" href="<?php echo base_url(); ?>css/demo_table_jui.css" type="text/css" />
<?php $cultivos = $this->PrediosDAO->obtener_cultivos($ficha); ?>
<table id="tabla-cultivos" style="width:100%; font-size: 13px">
    <thead>
        <tr>
            <th style="display:none;">Id</th>
            <th>Descripcion</th>
            <th>Cantidad</th>
            <th>Densidad</th>
            <th>Unidad</th>
        </tr>
    </thead>
    <tbody>
		<?php foreach ($cultivos as $cultivo): ?>
            <tr>
                <td style="display:none;"><?= $cultivo->id_cultivo_especie?></td>
                <td><?= $cultivo->descripcion ?></td>
                <td><?= $cultivo->cantidad ?></td>
                <td><?= $cultivo->densidad ?></td>
                <td><?= $cultivo->unidad ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#tabla-cultivos').dataTable({
        "bJQueryUI": true,
        "bSort": true,
        "sPaginationType": "full_numbers"
    });
});

$('#tabla-cultivos').find('tr').click( function(){
  alert('You clicked row '+ ($(this).index()+1) );
});

$('#guardar').click(() => {

});
</script>
