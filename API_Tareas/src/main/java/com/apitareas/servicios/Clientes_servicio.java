package com.apitareas.servicios;

import java.util.List;

import org.springframework.stereotype.Service;

import com.apitareas.modelos.Clientes;
import com.apitareas.modelos.Tarea;
import com.apitareas.repositorios.Clientes_Repositorio;

@Service
public class Clientes_servicio {
	private final Clientes_Repositorio cl;
	
	public Clientes_servicio(Clientes_Repositorio cl) {
		this.cl=cl;
	}

	public Clientes crearVehiculo(Clientes c)throws Exception {
		if(c.getMatricula()==null || c.getDniPropietario()==null
				||c.getModelo()==null
				||c.getNumReparaciones()==0
				||c.isEnReparacion()==false) {
			throw new Exception("Los datos Son Obligatorios");
		}
		return cl.save(c);
		
		
	}

	public List<Clientes> obtenerClientes() {
		return cl.findAll();
	}

	public boolean borrarVehiculosPorId(Long id) throws Exception {
		 Clientes BD = cl.findById(id).orElse(null);
		    if (BD == null) {
		        throw new Exception("El vehiculo con ID " + id + " no existe o ya fue eliminado.");
		    }
		    cl.deleteById(id);
		    return true;
	}

	
	
}
