package com.apitareas.servicios;

import java.util.List;

import org.springframework.stereotype.Service;

import com.apitareas.modelos.Tarea;
import com.apitareas.repositorios.Tarea_Repositorio;

@Service
public class Tarea_servicio {
	private final Tarea_Repositorio tr;

	public Tarea_Repositorio getTr() {
		return tr;
	}

	public Tarea_servicio(Tarea_Repositorio tr) {
		this.tr = tr;
	}
	public List<Tarea> obtenerTareas(){
		return tr.findAll();
		
	}
}