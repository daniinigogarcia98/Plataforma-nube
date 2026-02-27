package com.apitareas.controladores;

import java.util.List;

import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import com.apitareas.modelos.Clientes;
import com.apitareas.modelos.Tarea;
import com.apitareas.repositorios.Clientes_Repositorio;
import com.apitareas.servicios.Clientes_servicio;

@RestController
@RequestMapping("/api/clientes")
@CrossOrigin(origins = "*")
public class Clientes_Controlador {
private final Clientes_servicio cl;
	
	public Clientes_Controlador( Clientes_servicio cl) {
		this.cl=cl;
	}
	@GetMapping("/listarVehiculo")
	public List<Clientes> obtenerClientes(){
		return cl.obtenerClientes();
	}
	@PostMapping("/crear")
	public Clientes crearVehiculo(@RequestBody Clientes c) throws Exception {
		return cl.crearVehiculo(c) ;
		
	}
	@DeleteMapping("/borrar")
	 public boolean borrarVehiculos(@RequestParam  Long id) throws Exception {
        return cl.borrarVehiculosPorId(id);
    }
}
