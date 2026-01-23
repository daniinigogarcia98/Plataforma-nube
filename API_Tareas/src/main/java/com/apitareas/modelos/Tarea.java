package com.apitareas.modelos;

import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.Table;

@Entity
@Table
public class Tarea {
	@Id
	@GeneratedValue(strategy=GenerationType.IDENTITY)
	private  Long id;
	@Column(nullable=false)
	private String titulo;
	@Column(nullable=false)
	private String descricion;
	@Column(nullable=false)
	private String prioridad="media";
	@Column(nullable=false)
	private String estado="pendiente";
	
	public Tarea() {
		
	}

	public Tarea(Long id, String titulo, String descricion, String prioridad, String estado) {
		super();
		this.id = id;
		this.titulo = titulo;
		this.descricion = descricion;
		this.prioridad = prioridad;
		this.estado = estado;
	}

	public Long getId() {
		return id;
	}

	public void setId(Long id) {
		this.id = id;
	}

	public String getTitulo() {
		return titulo;
	}

	public void setTitulo(String titulo) {
		this.titulo = titulo;
	}

	public String getDescricion() {
		return descricion;
	}

	public void setDescricion(String descricion) {
		this.descricion = descricion;
	}

	public String getPrioridad() {
		return prioridad;
	}

	public void setPrioridad(String prioridad) {
		this.prioridad = prioridad;
	}

	public String getEstado() {
		return estado;
	}

	public void setEstado(String estado) {
		this.estado = estado;
	}
	
}