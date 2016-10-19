<link rel="stylesheet" href="<?= base_url(); ?>css/demo_table_jui.css" type="text/css" />
<table style="text-align:left" style="width:100%">
    <tbody>
        <tr>
            <td><?= form_label('Tipo documento', 'tipo_documento'); ?></td>
            <td><?= form_input(array('value'=>$propietario->tipo_documento, 'readonly'=>true)); ?></td>
            <td><?= form_label('Propietario', 'propietario'); ?></td>
            <td><?= form_input(array('value'=>$propietario->nombre, 'readonly'=>true)); ?></td>
        </tr>
        <tr>
            <td><?= form_label('Documento', 'documento_propietario'); ?></td>
            <td><?= form_input(array('value'=>$propietario->documento, 'readonly'=>true)); ?></td>
            <td><?= form_label('Telefono', 'telefono'); ?></td>
            <td><?= form_input(array('value'=>$propietario->telefono, 'readonly'=>true)); ?></td>
        </tr>
        <tr>
            <td><?= form_label('Dirección', 'direccion_propietario'); ?></td>
            <td><?= form_input(array('value'=>$propietario->direccion, 'readonly'=>true)); ?></td>
            <td><?= form_label('Correo electrónico', 'email_propietario'); ?></td>
            <td><?= form_input(array('value'=>$propietario->email, 'readonly'=>true)); ?></td>
        </tr>
    </tbody>

    <table id="tabla" style='width:100%'>
        <thead>
            <tr>
                <th>Predio</th>
                <th>Participacion</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($relaciones as $relacion): ?>
                <tr>
                    <td align="center"><?= $relacion->ficha_predial; ?></td>
                    <td align="right"><?= $relacion->participacion; ?>%</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</table>
<script type="text/javascript" src="<?= base_url(); ?>js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#tabla').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers",
            "aaSorting": [[ 1, "desc" ]]
		});
	});
</script>
