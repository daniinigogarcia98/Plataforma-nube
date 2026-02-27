package com.proyecto1;

import java.nio.file.Paths;
import java.util.ArrayList;

import org.springframework.stereotype.Service;

import software.amazon.awssdk.auth.credentials.ProfileCredentialsProvider;
import software.amazon.awssdk.enhanced.dynamodb.DynamoDbEnhancedClient;
import software.amazon.awssdk.enhanced.dynamodb.DynamoDbTable;
import software.amazon.awssdk.enhanced.dynamodb.Key;
import software.amazon.awssdk.enhanced.dynamodb.TableSchema;
import software.amazon.awssdk.enhanced.dynamodb.model.PageIterable;
import software.amazon.awssdk.profiles.ProfileFile;
import software.amazon.awssdk.regions.Region;
import software.amazon.awssdk.services.dynamodb.DynamoDbClient;
import software.amazon.awssdk.services.dynamodb.model.AttributeDefinition;
import software.amazon.awssdk.services.dynamodb.model.BillingMode;
import software.amazon.awssdk.services.dynamodb.model.CreateTableRequest;
import software.amazon.awssdk.services.dynamodb.model.KeySchemaElement;
import software.amazon.awssdk.services.dynamodb.model.KeyType;
import software.amazon.awssdk.services.dynamodb.model.ScalarAttributeType;

@Service
public class Servicio {
private DynamoDbClient clienteBajoNivel;
private DynamoDbEnhancedClient clienteMejorado;
private DynamoDbTable<Aula> tAula;

public Servicio() {
	//Configurar credenciales de Acceso
	ProfileCredentialsProvider credenciales = ProfileCredentialsProvider.builder()
		    .profileFile(ProfileFile.builder()
		        .type(ProfileFile.Type.CREDENTIALS)
		        .content(Paths.get(".env"))
		        .build())
		    .profileName("DynamoDB")
		    .build();
	//Cliente low-level
	clienteBajoNivel=DynamoDbClient.builder().region(Region.US_EAST_1).credentialsProvider(credenciales).build();
	//Cliente mejorado para usar Interfaz de alto nivel
	clienteMejorado=DynamoDbEnhancedClient.builder().dynamoDbClient(clienteBajoNivel).build();
	tAula=clienteMejorado.table("Aulas", TableSchema.fromBean(Aula.class));
}
public DynamoDbClient getClienteBajoNivel() {
	return clienteBajoNivel;
}
public void setClienteBajoNivel(DynamoDbClient clienteBajoNivel) {
	this.clienteBajoNivel = clienteBajoNivel;
}
public DynamoDbEnhancedClient getClienteMejorado() {
	return clienteMejorado;
}
public void setClienteMejorado(DynamoDbEnhancedClient clienteMejorado) {
	this.clienteMejorado = clienteMejorado;
}
public DynamoDbTable<Aula> gettAula() {
	return tAula;
}
public void settAula(DynamoDbTable<Aula> tAula) {
	this.tAula = tAula;
}
//Crear Tabla Aula ruta /crear
public Boolean crearTablaAula() {
	//Solicitud para crear la tabla
	CreateTableRequest request =CreateTableRequest.builder()
			.tableName("Aulas").keySchema(KeySchemaElement.builder()
					.attributeName("codigo")
					.keyType(KeyType.HASH)
					.build())
			.attributeDefinitions(AttributeDefinition.builder()
					.attributeName("codigo")
					.attributeType(ScalarAttributeType.S)
					.build())
			.billingMode(BillingMode.PAY_PER_REQUEST)
			.build();
	//Creación de la tabla y obteción de respuesta
	clienteBajoNivel.createTable(request);
	return true;
}
//Insertar Aula ruta /insertar
//opcion 1
public Aula insertarAula(Aula a)throws Exception {
	//Comprobar que no hay otro aula con el Mismo código
	Aula aux=obtenerAula(a.getCodigo());
	if(aux!=null) {
		tAula.putItem(a);
		return a;
	}else {
		throw new Exception("Ya Existe el aula"+a.getCodigo());
	}
}
//Obtener Aula ruta /obtener
public Aula obtenerAula(String codigo) {
	return tAula.getItem(Key.builder().partitionValue(codigo).build());
}
//opcion 2
/*public void insertarAula(Aula aula) {
    // TODO Auto-generated method stub
    try {
        // Versión larga, devuelve más información
        // Solicitud para insertar un item
        PutItemEnhancedRequest request = PutItemEnhancedRequest.builder(Aula.class)
            .item(aula)
            .returnConsumedCapacity(ReturnConsumedCapacity.TOTAL)
            .returnValues(ReturnValue.ALL_OLD) // Devuelve el esquema antiguo
            .build();

        // Ejecución del insert y obtención de respuesta
        PutItemEnhancedResponse<Aula> response = aula.putItemWithResponse(request);
        if (response.attributes() != null) {
            System.out.println("Aula creada");
        } else {
            System.out.println("Aula modificada (Valores Antiguos):" + response.attributes());
        }
        System.out.println("Capacidad Consumida: " + response.consumedCapacity());
    } catch (Exception e) {
        // TODO: handle exception
        e.printStackTrace();
    }
}*/

public ArrayList<Aula> obtenerTodas() {
	ArrayList<Aula> resultado =new ArrayList<>();
	PageIterable<Aula> datos=tAula.scan();
	for(Aula aula :datos.items()) {
		resultado.add(aula);
	}
	return resultado;
}
//modificar aula /modficar
//opcion1
public Aula modificar(String codigo, Aula a)throws Exception {
	Aula aux =obtenerAula(codigo);
	if(aux==null) {
		throw new Exception("No existe el aula");
	}
	a.setCodigo(aux.getCodigo());
	return tAula.updateItem(a);
}
//opcion2
/*
 public Aula modificarAula(Aula a) {
    // TODO Auto-generated method stub
    try {
        UpdateItemEnhancedRequest request = 
            UpdateItemEnhancedRequest.builder(Aula.class)
            .item(a)
            .returnConsumedCapacity(ReturnConsumedCapacity.TOTAL)
            .returnValues(ReturnValue.ALL_NEW)
            .build();
        
        UpdateItemEnhancedResponse<Aula> r = aula.updateItemWithResponse(request);
        System.out.println("Capacidad:" + r.consumedCapacity());
        return r.attributes(); //Elemento con los nuevos valores de los atributos
    } catch (Exception e) {
        // TODO: handle exception
        e.printStackTrace();
    }
    return a;
}
 */
public Boolean borrarAula(String codigo) throws Exception {
	// TODO Auto-generated method stub
	Aula a =obtenerAula(codigo);
	if(a == null) {
		throw new Exception("No existe el aula");
	}
	tAula.deleteItem(Key.builder().partitionValue(codigo).build());
	return true;
}

}
