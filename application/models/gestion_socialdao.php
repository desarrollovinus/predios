<?php
/**
 * DAO que se encarga de gestionar la informacion de la ficha social de los predios registrados en el sistema.
 * @author 		John Arley Cano Salinas
 * @copyright	2016
 */
class Gestion_socialDAO extends CI_Model
{
	function actualizar_ficha($ficha, $datos){
		$this->db->where('ficha_predial', $ficha);
		if($this->db->update('tbl_ficha_social', $datos)){
            //Retorna verdadero
            return true;
        }
	}

	function actualizar_usr($id, $datos){
		$this->db->where('id', $id);
		if($this->db->update('tbl_unidades_sociales_residentes', $datos)){
            //Retorna verdadero
            return true;
        }
	}

	function actualizar_usp($id, $datos){
		$this->db->where('id', $id);
		if($this->db->update('tbl_unidades_sociales_productivas', $datos)){
            //Retorna verdadero
            return true;
        }
	}

	function cargar_ficha($ficha_predial){
		$this->db->select('*');
		$this->db->where('ficha_predial', $ficha_predial);
	 	return $this->db->get('tbl_ficha_social')->row();
	}
	
	function cargar_valores_ficha($id_lista){
		$this->db->select('*');
		$this->db->where('id_lista_social', $id_lista);
		$this->db->order_by('nombre');
	 	return $this->db->get('tbl_valores_social')->result();
	}

	function cargar_valores_ficha_social($ficha, $id_unidad_social){
		$this->db->select('*');
		
		if ($id_unidad_social != 0) {
			$this->db->where('id_unidad_social', $id_unidad_social);
		}else{
			$this->db->where('ficha_predial', $ficha);
		}

	 	return $this->db->get('tbl_ficha_valores')->result();
	 	// return $ficha;
	}

	function insertar_ficha($datos){
		if($this->db->insert('tbl_ficha_social', $datos)){
			return true;
		}
	}

	function insertar_usp($datos){
		if($this->db->insert('tbl_unidades_sociales_productivas', $datos)){
			return true;
		}
	}

	function insertar_usr($datos){
		if($this->db->insert('tbl_unidades_sociales_residentes', $datos)){
			return true;
		}
	}

	function insertar_valor_ficha($datos){
		if($this->db->insert('tbl_ficha_valores', $datos)){
			return true;
		}
	}

	function eliminar_valores_ficha($datos){
		if($this->db->delete('tbl_ficha_valores', $datos)){
			return true;
		}
	}


	function cargar_unidad_social_residente($id){
		$this->db->select('*');
		$this->db->where('id', $id);
	 	return $this->db->get('tbl_unidades_sociales_residentes')->row();
	}

	function cargar_unidades_sociales_productivas(){
	 	$sql =
	 	"SELECT
			usp.id,
			usp.ficha_predial,
			v.nombre AS relacion_inmueble,
			usp.titular,
			(IF(usp.nombre_arrendatario1 <> '', 1, 0)) + 
			(IF(usp.nombre_arrendatario2 <> '', 1, 0)) + 
			(IF(usp.nombre_arrendatario3 <> '', 1, 0)) + 
			(IF(usp.nombre_arrendatario4 <> '', 1, 0)) + 
			(IF(usp.nombre_arrendatario5 <> '', 1, 0)) arrendatarios
		FROM
			tbl_unidades_sociales_productivas AS usp
		LEFT JOIN tbl_valores_social AS v ON usp.relacion_inmueble = v.id";

	 	return $this->db->query($sql)->result();
	}

	function cargar_unidades_sociales_residentes(){
		$sql =
		"SELECT
			usr.id,
			usr.ficha_predial,
			v.nombre AS relacion_inmueble,
			usr.responsable,
			(IF(usr.nombre_integrante1 <> '', 1, 0)) + 
			(IF(usr.nombre_integrante2 <> '', 1, 0)) + 
			(IF(usr.nombre_integrante3 <> '', 1, 0)) + 
			(IF(usr.nombre_integrante4 <> '', 1, 0)) + 
			(IF(usr.nombre_integrante5 <> '', 1, 0)) integrantes
		FROM
			tbl_unidades_sociales_residentes AS usr
		LEFT JOIN tbl_valores_social AS v ON usr.relacion_inmueble = v.id
		ORDER BY
			usr.ficha_predial ASC";

	 	return $this->db->query($sql)->result();
	}


	function cargar_unidad_social_productiva($id){
		$this->db->select('*');
		$this->db->where('id', $id);
	 	return $this->db->get('tbl_unidades_sociales_productivas')->row();
	}





}
/* End of file gestion_socialDAO.php */
/* Location: ./site_predios/application/models/gestion_socialDAO.php */