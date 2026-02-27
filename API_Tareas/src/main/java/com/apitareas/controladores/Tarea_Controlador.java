
package com.apitareas.controladores;

import java.util.List;

import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import com.apitareas.modelos.Tarea;
import com.apitareas.servicios.Tarea_servicio;

@RestController
@RequestMapping("/api/tareas")
@CrossOrigin(origins = "*")
public class Tarea_Controlador {
	private final Tarea_servicio ts;

	public Tarea_Controlador(Tarea_servicio ts) {
		this.ts = ts;
	}
	
	@GetMapping("/listar")
	public List<Tarea> obtenerTareas(){
		return ts.obtenerTareas();
	}
	
	@PostMapping("/crear")
	public Tarea crearTarea(@RequestBody Tarea t) throws Exception {
		return ts.crearTarea(t);
	}
	
	@PutMapping("/modificar")
	public Tarea modificarTarea( @RequestBody Tarea t) throws Exception {
		return ts.modificarTarea(t);
	}

	 @DeleteMapping("/borrar")
	    public boolean borrarTareas(@RequestParam  Long id) throws Exception {
	        return ts.borrarTareaPorId(id);
	    }
}
