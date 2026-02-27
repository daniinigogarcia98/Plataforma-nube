package com.apitareas.modelos;

import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.Table;

@Entity
@Table
public class Clientes {
	@Id
	@GeneratedValue(strategy = GenerationType.IDENTITY)
	private Long id;
	@Column(nullable=false,unique=true)
	private String matricula;
	@Column(nullable=false,unique=true)
	private String dniPropietario;
	@Column(nullable=false)
	private String modelo;
	@Column(nullable=false)
	private int numReparaciones;
	@Column(nullable=false)
	private boolean enReparacion;
	public Clientes() {
		
	}
	public Clientes(Long id,String matricula,String dniPropietario,String modelo,int numReparaciones,boolean enReparacion) {
		this.id=id;
		this.matricula=matricula;
		this.dniPropietario=dniPropietario;
		this.modelo=modelo;
		this.numReparaciones=numReparaciones;
		this.enReparacion=enReparacion;
	}
	public Long getId() {
		return id;
	}
	public void setId(Long id) {
		this.id = id;
	}
	public String getMatricula() {
		return matricula;
	}
	public void setMatricula(String matricula) {
		this.matricula = matricula;
	}
	public String getDniPropietario() {
		return dniPropietario;
	}
	public void setDniPropietario(String dniPropietario) {
		this.dniPropietario = dniPropietario;
	}
	public String getModelo() {
		return modelo;
	}
	public void setModelo(String modelo) {
		this.modelo = modelo;
	}
	public int getNumReparaciones() {
		return numReparaciones;
	}
	public void setNumReparaciones(int numReparaciones) {
		this.numReparaciones = numReparaciones;
	}
	public boolean isEnReparacion() {
		return enReparacion;
	}
	public void setEnReparacion(boolean enReparacion) {
		this.enReparacion = enReparacion;
	}
	
}
