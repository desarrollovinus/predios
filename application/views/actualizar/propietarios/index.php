<h4 style="display: inline-block;">Propietarios <?php echo $ficha; ?></h4>
<p style="float: right;">
    <input type="button" value="Agregar" onClick="agregar_modal()" class="ui-button ui-widget ui-state-default ui-corner-all">
    <input type="button" value="Nuevo" onClick="crear()" class="ui-button ui-widget ui-state-default ui-corner-all">
    <input type="button" value="Volver" onClick="javascript:volver()" class="ui-button ui-widget ui-state-default ui-corner-all">
</p>

<!-- Confirmación de eliminación -->
<div id="dialog-confirm" title="Eliminar propietario" hidden>
    ¿Esta seguro(a) de realizar esta acción?
</div>

<!-- Contenedor de propietarios -->
<div id="cont_propietarios"></div>
<div id="cont_modal"></div>
<div id="cont_agregar" hidden>
    <?= form_label('Numero de documento', 'documento_buscar') ?>
    <?php $data = array('name'=>'documento_buscar') ?>
    <?= form_input($data) ?>
    <input type="button" name="buscar" value="Buscar" onClick="buscar()" class="ui-button ui-widget ui-state-default ui-corner-all">
    <div id="resultado_busqueda"></div>
</div>

<script type="text/javascript">
    /**
     * Función que agrega un registro existente
     */
    function agregar_modal()
    {
        $( "#cont_agregar" ).dialog({
            modal: true,
            height:310,
            width:760,
        });
    }

    function agregar(id) {
        var participacion = $("input[name=participacion_nuevo]");
        var datos = {
            'id_propietario':id,
            'ficha_predial':"<?= $ficha?>",
            'participacion':participacion.val()
        };
        console.log(datos);
        ajax("<?= site_url('actualizar_controller/crear'); ?>", {"tipo": "propietario_relacion", "datos": datos}, "html");
        listar();
        cerrar_modal();
    }

    function buscar()
    {
        var documento = $("input[name=documento_buscar]");
        documento = documento.val();
        cargar_interfaz("resultado_busqueda", "<?= site_url('actualizar_controller/cargar_interfaz'); ?>", {"tipo": "propietario_buscar", "ficha": "<?= $ficha; ?>", "documento": documento});
    }

    /**
	 * Función que crea un registro
	 */
    function crear()
    {
		// Carga de interfaz
		cargar_interfaz("cont_modal", "<?= site_url('actualizar_controller/cargar_interfaz'); ?>", {"tipo": "propietarios_gestion", "ficha": "<?= $ficha; ?>", "id": 0});
    } // crear

    /**
	 * Función que actualiza un registro
	 */
    function editar(id)
    {
    	// Carga de interfaz
		cargar_interfaz("cont_modal", "<?= site_url('actualizar_controller/cargar_interfaz'); ?>", {"tipo": "propietarios_gestion", "ficha": "<?= $ficha; ?>", "id": id});
    } // editar

	/**
	 * Función que guarda o actualiza el registro del propietarios
	 */
	function guardar()
	{
		// Declaración de variables
		var id = $("#id_propietario").val();
	    var tipo_documento = $("input[name=tipo_documento]");
	    var documento = $("input[name=documento]");
	    var nombre = $("input[name=nombre]");
	    var telefono = $("input[name=telefono]");
        var direccion = $("input[name=direccion]");
        var email = $("input[name=email]");
        var participacion = $("input[name=participacion]");

	    //Datos a validar
	    datos_obligatorios = new Array(
			tipo_documento.val(),
			documento.val(),
			nombre.val(),
            participacion.val()
	    );
	    // imprimir(datos_obligatorios);

	    //Se ejecuta la validación de los campos obligatorios
	    validacion = validar_campos_vacios(datos_obligatorios);

	    //Si no supera la validacíón
	    if (!validacion) {
	        // Mensaje de advertencia
	        $("#error").html('<div id="alerta" class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0px 0.7em;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>Llene los campos obligatorios</p></div>');

	        return false;
	    } // if

	    // Arreglo de datos a guardar
	    var datos = {
	        "tipo_documento": tipo_documento.val(),
	        "documento": documento.val(),
	        "nombre": nombre.val(),
	        "telefono": telefono.val(),
	        "direccion": direccion.val(),
            "email": email.val()
	    };
	    // imprimir(datos);

	    // Si es edición
	    if (id) {
    		// Se actualiza el registro
            datos['participacion'] = participacion.val();
            datos['ficha_predial'] = "<?= $ficha ?>";
            ajax("<?= site_url('actualizar_controller/actualizar'); ?>", {"tipo": "propietario", "datos": datos, "id": id}, "html");
	    } else {
    		// Se crea el registro
            ajax("<?php echo site_url('actualizar_controller/crear'); ?>", {"tipo": "propietario", "datos": datos}, "html");
	    } // if

	    // Se listan los cultivos
	    listar();

	    // Se cierra el modal
	    cerrar_modal();
	} // guardar

	/**
	 * Listado de los registros
	 */
	function listar()
	{
		// Carga de interfaz
		cargar_interfaz("cont_propietarios", "<?= site_url('actualizar_controller/cargar_interfaz'); ?>", {"tipo": "propietarios_lista", "ficha": "<?= $ficha; ?>"});
	} // listar

	function volver()
	{
		// Se devuelve a la página general de edición del predio
		location.reload();
	} // volver

	// Cuando el DOM esté listo
	$(document).ready(function(){
		// Por defecto, cargamos la lista de cultivos
		listar();
	}); // document.ready
</script>
