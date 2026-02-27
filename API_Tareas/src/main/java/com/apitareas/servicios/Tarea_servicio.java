package com.apitareas.servicios;

import java.util.List;
import java.util.Optional;

import org.springframework.stereotype.Service;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestBody;

import com.apitareas.modelos.Tarea;
import com.apitareas.repositorios.Tarea_Repositorio;

@Service
public class Tarea_servicio {
	
	private final Tarea_Repositorio tr;

	public Tarea_servicio(Tarea_Repositorio tr) {
		this.tr = tr;
	}
	
	public List<Tarea> obtenerTareas(){
		return tr.findAll();
	}
	
	public Tarea crearTarea(Tarea t) throws Exception {
		if(t.getDescripcion()==null || t.getEstado()==null 
				|| t.getPrioridad()==null || t.getTitulo()==null
				|| t.getFechaC()==null) {
			throw new Exception("Faltan datos obligatorios");
		}
		//Comprobar que el estado tiene un valor correcto
		if(t.getEstado()!=null && !t.getEstado().equalsIgnoreCase("Pendiente")
				&& !t.getEstado().equalsIgnoreCase("Iniciada")
				&& !t.getEstado().equalsIgnoreCase("Finalizada")) {
			throw new Exception("Valor de estado incorrecto");
		}
		//Comprobar que el prioridad tiene un valor correcto
		if(t.getPrioridad()!=null && !t.getPrioridad().equalsIgnoreCase("baja")
				&& !t.getPrioridad().equalsIgnoreCase("media")
				&& !t.getPrioridad().equalsIgnoreCase("alta")) {
			throw new Exception("Valor de prioridad incorrecto");
		}
		return tr.save(t);
	}

	public Tarea modificarTarea(Tarea t) throws Exception {
		// TODO Auto-generated method stub
		//Comprobar que se pasa id en el json
		if(t.getId()==null) {
			throw new Exception("Id de tarea es obligatorio");
		}
		//Comprobar que el estado tiene un valor correcto
		if(t.getEstado()!=null && !t.getEstado().equalsIgnoreCase("Pendiente")
				&& !t.getEstado().equalsIgnoreCase("Iniciada")
				&& !t.getEstado().equalsIgnoreCase("Finalizada")) {
			throw new Exception("Valor de estado incorrecto");
		}
		//Comprobar que el prioridad tiene un valor correcto
		if(t.getPrioridad()!=null && !t.getPrioridad().equalsIgnoreCase("baja")
				&& !t.getPrioridad().equalsIgnoreCase("media")
				&& !t.getPrioridad().equalsIgnoreCase("alta")) {
			throw new Exception("Valor de prioridad incorrecto");
		}
		//Comprobar que la tarea que se va a modificar existe
		Tarea tBD = tr.findById(t.getId()).orElse(null);
		if(tBD==null) {
			throw new Exception("No existe tareas");
		}
		//Establecer el nuevo valor de los campos que vienen JSON
		if(t.getTitulo()!=null) {
			tBD.setTitulo(t.getTitulo());
		}
		if(t.getEstado()!=null) {
			tBD.setEstado(t.getEstado());
		}
		if(t.getPrioridad()!=null) {
			tBD.setPrioridad(t.getPrioridad());
		}
		if(t.getDescripcion()!=null) {
			tBD.setDescripcion(t.getDescripcion());
		}
		//Modificar la tarea
		return tr.save(tBD);
	}
	
	public Tarea modificarTareaID(Long id, Tarea t) throws Exception {
	    // Comprobar que el estado tiene un valor correcto
	    if (t.getEstado() != null && !t.getEstado().equalsIgnoreCase("Pendiente")
	            && !t.getEstado().equalsIgnoreCase("Iniciada")
	            && !t.getEstado().equalsIgnoreCase("Finalizada")) {
	        throw new Exception("Valor de estado incorrecto");
	    }

	    // Comprobar que la prioridad tiene un valor correcto
	    if (t.getPrioridad() != null && !t.getPrioridad().equalsIgnoreCase("baja")
	            && !t.getPrioridad().equalsIgnoreCase("media")
	            && !t.getPrioridad().equalsIgnoreCase("alta")) {
	        throw new Exception("Valor de prioridad incorrecto");
	    }

	    // Comprobar que la tarea que se va a modificar existe
	    Tarea tBD = tr.findById(id).orElse(null);
	    if (tBD == null) {
	        throw new Exception("No existe tarea con ese id");
	    }

	    // Establecer el nuevo valor de los campos que vienen en el JSON
	    if (t.getTitulo() != null) {
	        tBD.setTitulo(t.getTitulo());
	    }
	    if (t.getEstado() != null) {
	        tBD.setEstado(t.getEstado());
	    }
	    if (t.getPrioridad() != null) {
	        tBD.setPrioridad(t.getPrioridad());
	    }
	    if (t.getDescripcion() != null) {
	        tBD.setDescripcion(t.getDescripcion());
	    }

	    // Modificar la tarea
	    return tr.save(tBD);
	}



	public boolean borrarTareaPorId(Long id) throws Exception {
	    Tarea tBD = tr.findById(id).orElse(null);
	    if (tBD == null) {
	        throw new Exception("La tarea con ID " + id + " no existe o ya fue eliminada.");
	    }
	    tr.deleteById(id);
	    return true;
	}

}