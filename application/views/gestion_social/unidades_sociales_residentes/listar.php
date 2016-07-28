<link rel="stylesheet" href="<?php echo base_url(); ?>css/demo_table_jui.css" type="text/css" />

<input type="button" onclick="javascript:crear()" value="Nuevo">
<br>

<table style="width:100%; font-size: 13px">
	<thead>
		<tr>
			<th>Ficha predial</th>
			<th>Relación con inmueble</th>
			<th>Responsable</th>
			<th>Integrantes</th>
			<th width="15%">Opciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($unidades_sociales_residentes as $usr): ?>
			<tr>
				<td><?php echo $usr->ficha_predial; ?></td>
				<td><?php echo $usr->relacion_inmueble; ?></td>
				<td><?php echo $usr->responsable; ?></td>
				<td align="right"><?php echo $usr->integrantes; ?></td>
				<td>
					<a onclick="javascript:editar('<?php echo $usr->id; ?>')" style="cursor: pointer">
						<img src="<?php echo base_url(); ?>img/edit.png" title="Editar información">
					</a>
					<?php echo anchor("informes_controller/ficha_social_usr/". $usr->id, '<img src="'.base_url().'img/excel.png"', 'title="Generar formato de caracterización general unidades residentes"'); ?>
					<?php echo anchor("archivos_controller/ver_fotos?ficha=".$usr->ficha_predial."&tipo=3&id=".$usr->id, '<img src="'.base_url().'img/camara.png"', 'title="Subir fotos"'); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#form table').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});

		//esta sentencia es para darle el estilo a los botones jquery.ui
	    $( "#form input[type=submit], #form input[type=button]").button();
	});
</script>
