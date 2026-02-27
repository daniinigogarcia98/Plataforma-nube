package com.proyecto1;

import software.amazon.awssdk.enhanced.dynamodb.mapper.annotations.DynamoDbAttribute;
import software.amazon.awssdk.enhanced.dynamodb.mapper.annotations.DynamoDbBean;

@DynamoDbBean
public class Recurso {
	private int codigo;
	private String nombre;
public  Recurso() {

}
public  Recurso(int codigo,String nombre) {
	this.codigo=codigo;
	this.nombre=nombre;
}
@DynamoDbAttribute("codigo")
public int getCodigo() {
	return codigo;
}
public void setCodigo(int codigo) {
	this.codigo = codigo;
}
@DynamoDbAttribute("nombre")
public String getNombre() {
	return nombre;
}
public void setNombre(String nombre) {
	this.nombre = nombre;
}
@Override
public String toString() {
	return"Recurso[codigo="+codigo+",nombre="+nombre +"]";
}


}
