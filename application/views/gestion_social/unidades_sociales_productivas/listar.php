<link rel="stylesheet" href="<?php echo base_url(); ?>css/demo_table_jui.css" type="text/css" />

<input type="button" onclick="javascript:crear()" value="Nueva">
<br>

<table style="width:100%; font-size: 13px">
	<thead>
		<tr>
			<th>Ficha predial</th>
			<th>Relación con inmueble</th>
			<th>Titular</th>
			<th>Arrendatarios</th>
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($unidades_sociales_productivas as $usp): ?>
			<tr>
				<td><?php echo $usp->ficha_predial; ?></td>
				<td><?php echo $usp->relacion_inmueble; ?></td>
				<td><?php echo $usp->titular; ?></td>
				<td align="right"><?php echo $usp->arrendatarios; ?></td>
				<td>
					<a onclick="javascript:editar('<?php echo $usp->id; ?>', '<?php echo $usp->ficha_predial; ?>')" style="cursor: pointer">
						<img src="<?php echo base_url(); ?>img/edit.png" title="Editar unidad social productiva">
					</a>
					<?php echo anchor("archivos_controller/ver_fotos?ficha=".$usp->ficha_predial."&tipo=4&id=".$usp->id, '<img src="'.base_url().'img/camara.png"', 'title="Subir fotos"'); ?>
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
