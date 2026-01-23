package com.apitareas.repositorios;

import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.apitareas.modelos.Tarea;
@Repository
public interface Tarea_Repositorio extends JpaRepository<Tarea, Long>{
//conttiene métodos para hacer CRUD, si tener que programar nada
//find fndById,save,delete,ect..
//Podemos definir nuevos métodos
	//Obtener tareas por estado
	List<Tarea> findByEstado(String Estado);
	//Obtener tareas por prioridad
	List<Tarea> findByPrioridad(String priotidad);
}
