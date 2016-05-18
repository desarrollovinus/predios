<?php
$permisos = $this->session->userdata('permisos');
?>

<div id="form">
	<?php echo form_fieldset('<b>Unidades sociales productivas</b>'); ?>
		<div id="tabla">
			
		</div>
	<?php echo form_fieldset_close(); ?>
</div>

<script type="text/javascript">
	/**
	 * Función de creación del registro
	 * @return void 
	 */
	function crear()
	{
    	// Se carga la interfaz
		$("#form").load("<?php echo site_url('gestion_social_controller/ficha_social_productiva'); ?>" + "/" + 0);
	} // crear

	/**
	 * Función que se activa al presionar el botón editar del menú
	 * @return void 
	 */
	function editar(id, ficha_predial)
	{
		// Se carga la interfaz
		$("#form").load("<?php echo site_url('gestion_social_controller/ficha_social_productiva'); ?>" + "/" + id + "/" + ficha_predial);
	} // editar

	/**
	 * Listado de los registros
	 */
	function listar()
	{
		// Carga de interfaz
		$("#tabla").load("<?php echo site_url('gestion_social_controller/cargar_unidades_sociales_productivas'); ?>");
	} // listar


	$(document).ready(function(){
		// Por defecto, cargamos la interfaz de la tabla
		listar();
	});
</script>