<script src="<?php echo base_url(); ?>js/ajaxupload.2.0.min.js"></script>

<div id="form">
	<?php
	// Permisos
	$permisos = $this->session->userdata('permisos');

	echo form_fieldset('<b>Gestor de fotos</b>');
	?>
	<table style="text-align:'left'">
		<tbody>
			<tr>
				<td width="10%"><?php echo form_label('Fecha','fecha'); ?></td>
				<td width="20%"><?php echo form_input('fecha'); ?></td>
				<td width="10%"><?php echo form_label('Descripción','descripcion'); ?></td>
				<td width="20%"><?php echo form_input('descripcion'); ?></td>
				<td idth="40%">
					<?php
					if(isset($permisos['Archivos y Fotos']['Subir'])) {
						echo '<p><input type="file" id="btn_subir_certificado" class="btn_fotos"></p>';
					}
					?>
				</td>
			</tr>
		</tbody>
	</table>
	<div id="error"></div>
	<div id="fotos-container" onchange="ordenar()">

	<?php

	$cont = 1;
	$max = count($fotos);
	// Si tiene fotos
	if($max > 0) {
		// Recorrido de las fotos
		foreach($fotos as $foto) {
			// Se consulta los datos de la foto
		?>
			<div class="fotos" id="foto<?php echo $cont; ?>" orden="<?php echo ($foto->orden) ? $foto->orden: $max;?>">
				<!-- Foto -->
				<img src="<?php echo base_url().$directorio."/".$foto->archivo; ?>" height="210"><br>

				<!-- Eliminar -->
				<a href="#">
					<img onCLick="javascript:eliminar_foto('<?php echo $cont; ?>', '<?php echo $directorio."/".$foto->archivo; ?>', '<?php echo $foto->archivo; ?>')" alt="Eliminar foto" title="Eliminar foto" src="<?php echo base_url(); ?>img/delete.png" width="16px" align="right"><br>
				</a>

				<!-- Datos de la foto -->
				<strong>Foto <?php echo $cont; ?></strong><br>
				<strong>Fecha: </strong><?php if(isset($foto->fecha)){ echo $foto->fecha; } ?><br>
				<strong>Desripción: </strong><?php if(isset($foto->fecha)){ echo $foto->descripcion; } ?><br>
				<input onChange="javascript:actualizar_foto(this.value, '<?php echo $foto->archivo; ?>')" type="range" name="orden" value='<?php echo ($foto->orden) ? $foto->orden: $max; ?>' min="1" max='<?php echo $max?>'>
			</div>
		<?php
			$cont++;
		} // foreach fotos
	} // if
	echo form_close();
	?>
</div>
</div>

<div id="form">
	<?php
		if(isset($permisos['Archivos y Fotos']['Subir'])) {

			$volver = array(
				'type' => 'button',
				'name' => 'volver',
				'id' => 'volver',
				'value' => 'Volver'
			);
			echo "<br>".form_input($volver);

			$subir = array(
				'type' => 'submit',
				'name' => 'subir',
				'id' => 'subir',
				'value' => 'Subir'
			);
			// echo form_input($subir);

			echo form_close();
		}
	?>
</div>

<script type="text/javascript">
	// se obtienen todos los input de tipo range
	let ranges = $("[type=range]");

	for (let i = 0; i < ranges.length; i++) {
		ranges[i].parentNode.getElementsByTagName("strong")[0].innerHTML = `Foto: ${ranges[i].value}`;
	}

	//modifica el orden de la foto en el DOM cuando se mueve el mouse
	ranges.mousemove((e) => {
		e.target.parentNode.getElementsByTagName("strong")[0].innerHTML = `Foto: ${e.target.value}`;
		e.target.parentNode.setAttribute("orden", e.target.value);
	});

	ranges.change((e) => {
		e.target.parentNode.getElementsByTagName("strong")[0].innerHTML = `Foto: ${e.target.value}`;
		e.target.parentNode.setAttribute("orden", e.target.value);
	});

	function ordenar() {
		var $fotos = $("#fotos-container");
		$fotos.find('.fotos').sort((a, b) => {
			return a.getAttribute('orden') - b.getAttribute('orden');
		})
		.appendTo($("#fotos-container"));
	}

	function actualizar_foto(orden, nombre) {
		// Esta es la petición ajax que actualizara el orden de las fotos
		$.ajax({
				url: "<?php echo site_url('archivos_controller/actualizar_foto'); ?>",
				data: {"orden": orden, "nombre": nombre},
				type: "POST",
				dataType: "HTML",
				async: false,
				success: function(respuesta){
					console.log(respuesta);
				},//Success
				error: function(respuesta){
					console.log(respuesta);
				}//Error
		});//Ajax
	}

	function eliminar_foto(numero, url, nombre){
		console.log(nombre);
		//Variable de exito
	    var exito;

	    // Esta es la petición ajax que llevará
	    // a la interfaz los datos pedidos
	    $.ajax({
	        url: "<?php echo site_url('archivos_controller/eliminar_foto'); ?>",
	        data: {"archivo": url, "nombre": nombre},
	        type: "POST",
	        dataType: "HTML",
	        async: false,
	        success: function(respuesta){ console.log(respuesta);
	            //Si la respuesta no es error
	            if(respuesta){
	                //Se almacena la respuesta como variable de éxito
	                exito = respuesta;
	            } else {
	                //La variable de éxito será un mensaje de error
	                exito = "error";
	            } //If
	        },//Success
	        error: function(respuesta){
	            //Variable de exito será mensaje de error de ajax
	            exito = respuesta;
	        }//Error
	    });//Ajax

	    // Si se borró correctamente
	    if (exito) {
	    	$("#foto" + numero).hide("slow");
			setTimeout(()=>{location.reload();}, 1000);
	    }
	}

	$(document).ready(function(){
		ordenar();
		$('#form input[name^=fecha]').datepicker();

		// Declaración del arreglo
        var datos = {};

        //Se prepara la subida del archivo
        new AjaxUpload('#btn_subir_certificado', {
            action: '<?php echo site_url("archivos_controller/subir_fotos"); ?>',
            type: 'POST',
            data: datos,
            onSubmit : function(archivo , ext){
                // Se valida que tenga fecha y descripcion
                if ($("input[name=fecha]").val() == "" || $("input[name=descripcion]").val() == "") {
                	// Mensaje de advertencia
					$("#error").html('<div id="alerta" class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0px 0.7em;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>Tiene que especificar una fecha y una descripción</p></div>');
					return false;
                } // if

                // Se valida que sea una foto
                if (!(ext && /^(jpg|JPG|jpeg|JPEG)$/.test(ext))){
                    //Se muestra el mensaje de error
					$("#error").html('<div id="alerta" class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0px 0.7em;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>No es una foto</p></div>');
                    return false;
                } // if

                // Se arregan al arreglo JSON los datos a enviar
                datos['fecha'] = $("input[name=fecha]").val();
                datos['descripcion'] = $("input[name=descripcion]").val();
                datos['ficha'] = "<?php echo $this->uri->segment(3); ?>";
				datos['orden'] = "<?php echo $max + 1; ?>";

                console.log(datos);
            }, // onsubmit
            onComplete: function(archivo, respuesta){
				console.log(respuesta);
                if(respuesta == "existe"){
                    // Se muestra el mensaje de error
					$("#error").html('<div id="alerta" class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0px 0.7em;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>No se puede subir el certificado, Ya existe</p></div>');
					return false;
                } // if
                // Si la respuesta es verdadera
                if(respuesta == 1) {
                	location.reload();
                }else if(respuesta == "size") {
					$("#error").html('<div id="alerta" class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0px 0.7em;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>Solo se permiten fotos horizontales.</p></div>');
                } else {
					$("#error").html('<div id="alerta" class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0px 0.7em;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>No se pudo subir el certificado.</p></div>');
                } // if
            } // oncomplete
        }); // AjaxUpload

		$('#form input[name=volver]').click(function(){
			history.back();
		});
	});
</script>
