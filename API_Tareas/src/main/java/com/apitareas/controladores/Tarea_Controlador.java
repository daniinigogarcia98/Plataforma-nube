package com.apitareas.controladores;

import java.util.List;

import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.apitareas.modelos.Tarea;
import com.apitareas.servicios.Tarea_servicio;

@RestController
@RequestMapping("/api/tareas")
@CrossOrigin(origins="*")
public class Tarea_Controlador {
	private final Tarea_servicio ts;

	public Tarea_Controlador(Tarea_servicio ts) {
		this.ts = ts;
	}
	@GetMapping("/listar")
	public List<Tarea> listar(){
		return ts.obtenerTareas();
	}
}
