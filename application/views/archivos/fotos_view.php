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

	<?php

	$cont = 1;

	// Si tiene fotos
	if(count($fotos) > 0) {
		// Recorrido de las fotos
		foreach($fotos as $foto) {
			// Se consulta los datos de la foto
			$dato = $this->accionesDAO->consultar_foto($foto);
		?>
			<div class="fotos" id="foto<?php echo $cont; ?>">
				<!-- Foto -->
				<img src="<?php echo base_url().$directorio."/".$foto; ?>" width="280px"><br>
				
				<!-- Eliminar -->
				<a href="#">
					<img onCLick="javascript:eliminar_foto('<?php echo $cont; ?>', '<?php echo $directorio."/".$foto; ?>', '<?php echo $foto; ?>')" alt="Eliminar foto" title="Eliminar foto" src="<?php echo base_url(); ?>img/delete.png" width="16px" align="right"><br>
				</a>
				
				<!-- Datos de la foto -->
				<strong>Foto <?php echo $cont; ?></strong><br>
				<strong>Fecha: </strong><?php if(isset($dato->fecha)){ echo $dato->fecha; } ?><br>
				<strong>Desripción: </strong><?php if(isset($dato->fecha)){ echo $dato->descripcion; } ?><br>
			</div>
		<?php
			$cont++;
		} // foreach fotos
	} // if
	echo form_close();
	?>
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
	function eliminar_foto(numero, url, nombre){ console.log(nombre)
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
	        success: function(respuesta){ console.log(respuesta)
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
	    }
	}
	
	$(document).ready(function(){
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
                	alert("Tiene que especificar una fecha y una descripción");

                	return false;
                } // if

                // Se valida que sea una foto
                if (!(ext && /^(jpg|JPG|jpeg|JPEG)$/.test(ext))){
                    //Se muestra el mensaje de error
                    alert("No es una foto");

                    return false;
                } // if

                // Se arregan al arreglo JSON los datos a enviar
                datos['fecha'] = $("input[name=fecha]").val();
                datos['descripcion'] = $("input[name=descripcion]").val();
                datos['ficha'] = "<?php echo $this->uri->segment(3); ?>";

                console.log(datos);
            }, // onsubmit
            onComplete: function(archivo, respuesta){
                if(respuesta == "existe"){
                    // Se muestra el mensaje de error
                    alert('No se puede subir el certificado. Ya existe.');

                    return false;
                } // if
                // Si la respuesta es verdadera
                if(respuesta){
                	location.reload();
                }else{
	                alert("No se pudo subir el certificado");
                } // if
            } // oncomplete
        }); // AjaxUpload

		$('#form input[name=volver]').click(function(){
			history.back();
		});
	});
</script>
