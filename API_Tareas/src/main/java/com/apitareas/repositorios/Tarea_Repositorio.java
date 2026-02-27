package com.apitareas.repositorios;

import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.apitareas.modelos.Tarea;

@Repository
public interface Tarea_Repositorio extends JpaRepository<Tarea, Long>{
	//Contiene métodos para hacer CRUD, si tener que programar nada
	//find findById, save, delete, etc ....
	
	//Podemos definir nuevos métodos
	//Obetner tareas por estado
	List<Tarea> findByEstado(String estado);
		
	
	//Obtener tareas por prioridad
	List<Tarea> findByPrioridad(String prioridad);
		
}