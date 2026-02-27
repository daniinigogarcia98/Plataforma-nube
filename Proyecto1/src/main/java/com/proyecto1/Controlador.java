package com.proyecto1;

import java.util.ArrayList;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

@RestController
@RequestMapping("api/aulas")
@CrossOrigin("*")
public class Controlador {
	private final Servicio servicio;
	
	@Autowired
	public Controlador(Servicio s) {
		this.servicio= s;
	}
	@PostMapping("/crear")
	public Boolean crearTabla() {
		return servicio.crearTablaAula();
	}
	@PostMapping("/insertar")
	public Aula insertar(@RequestBody Aula a)throws Exception{
		return servicio.insertarAula(a);
	}
	@GetMapping("/listar")
	public ArrayList<Aula> obtenerTodas(){
		return servicio.obtenerTodas();
	}
	@GetMapping("/obtener")
	public Aula obtenerAula(@RequestParam String codigo) {
		return servicio.obtenerAula(codigo);
	}
	@PutMapping("/modificar")
	public Aula modificar(@RequestParam String codigo,@RequestBody Aula a)throws Exception {
		return servicio.modificar(codigo,a);
	
}
	@DeleteMapping("/borrar")
	public Boolean borrar(@RequestParam String codigo)throws Exception {
		return servicio.borrarAula(codigo);
	
}
}