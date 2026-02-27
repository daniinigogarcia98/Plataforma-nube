package com.apitareas.repositorios;

import org.springframework.data.jpa.repository.JpaRepository;

import com.apitareas.modelos.Clientes;

public interface Clientes_Repositorio extends JpaRepository<Clientes,Long> {
	
}
