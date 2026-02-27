package com.proyecto1;

import java.util.ArrayList;
import java.util.List;

import software.amazon.awssdk.enhanced.dynamodb.mapper.annotations.DynamoDbAttribute;
import software.amazon.awssdk.enhanced.dynamodb.mapper.annotations.DynamoDbBean;
import software.amazon.awssdk.enhanced.dynamodb.mapper.annotations.DynamoDbPartitionKey;

@DynamoDbBean
public class Aula {
private String codigo;
private int metros;
private List<Recurso>recursos =new ArrayList<Recurso>();

public Aula() {
	
}
public Aula(String codigo, int metros) {
	super();
	this.codigo=codigo;
	this.metros=metros;
}
@DynamoDbPartitionKey
public String getCodigo() {
	return codigo;
}
public void setCodigo(String codigo) {
	this.codigo = codigo;
}
@DynamoDbAttribute("metros")
public int getMetros() {
	return metros;
}
public void setMetros(int metros) {
	this.metros = metros;
}
@DynamoDbAttribute("recursos")
public List<Recurso> getRecursos() {
	return recursos;
}
public void setRecursos(List<Recurso> recursos) {
	this.recursos = recursos;
}



}