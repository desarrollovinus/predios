<link rel="stylesheet" href="<?php echo base_url(); ?>css/demo_table_jui.css" type="text/css" />
<?php // if (isset($permisos['Fichas']['Actualizar'])) { ?><img src="<?php echo base_url(); ?>img/edit.png" title="Actualizar" >: Actualizar Ficha <?php // } ?> 

<table style="width:100%; font-size: 13px">
	<thead>
		<tr>
			<th>Ficha predial</th>
			<th>Primer propietario</th>
			<th>Unidades residentes</th>
			<th>Unidades productivas</th>
			<th>Opciones</th>
		</tr>
		<tbody>
			<?php foreach ($fichas as $ficha): ?>
				<tr>
					<td><?php echo $ficha->ficha_predial; ?></td>
					<td><?php echo $ficha->propietario; ?></td>
					<td><?php echo $ficha->usr; ?></td>
					<td><?php echo $ficha->usp; ?></td>
					<td>
						<a onclick="javascript:editar('<?php echo $ficha->id_predio; ?>', '<?php echo $ficha->ficha_predial; ?>')" style="cursor: pointer">
							<img src="<?php echo base_url(); ?>img/edit.png" title="Editar información">
						</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</thead>
</table>

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#form table').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});
	});
</script>