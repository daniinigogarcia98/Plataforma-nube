const apiUrllistar = 'http://localhost:8080/api/tareas/listar';
const apiUrlcrear = 'http://localhost:8080/api/tareas/crear';
const apiUrlmodificar = 'http://localhost:8080/api/tareas/modificar';
const apiUrlborrar = 'http://localhost:8080/api/tareas/borrar';
// Función para mostrar mensajes
function mostrarMensaje(mensaje, tipo = 'success') {
    const mensajeDiv = document.getElementById('mensaje');
    mensajeDiv.className = tipo === 'success' ? 'alert alert-success' : 'alert alert-danger';
    mensajeDiv.textContent = mensaje;
    mensajeDiv.style.display = 'block';
}

// Crear tarea
document.getElementById('formCrearTarea').addEventListener('submit', function(event) {
    event.preventDefault();
    const tareaData = {
        titulo: document.getElementById('titulo').value,
        descripcion: document.getElementById('descripcion').value,
        prioridad: document.getElementById('prioridad').value,
        estado: document.getElementById('estado').value
    };
    axios.post(apiUrlcrear, tareaData)
        .then(() => {
            mostrarMensaje('Tarea creada');
            obtenerTareas();
        })
        .catch(error => mostrarMensaje('Error: ' + error.message, 'danger'));
});

// Obtener tareas
function obtenerTareas() {
    axios.get(apiUrllistar)
        .then(response => {
            const tablaTareas = document.getElementById('tablaTareas').getElementsByTagName('tbody')[0];
            tablaTareas.innerHTML = '';
            response.data.forEach(tarea => {
                tablaTareas.insertRow().innerHTML = `
                    <td>${tarea.id}</td>
                    <td>${tarea.titulo}</td>
                    <td>${tarea.descripcion}</td>
                    <td>${tarea.fechaC}</td>
                    <td>${tarea.prioridad}</td>
                    <td>${tarea.estado}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="cambiarEstado(${tarea.id}, 'Iniciada')">Iniciar</button>
                        <button class="btn btn-success btn-sm" onclick="cambiarEstado(${tarea.id}, 'Finalizada')">Finalizar</button>
                        <button class="btn btn-danger btn-sm" onclick="eliminarTarea(${tarea.id})">Borrar</button>
                    </td>
                `;
            });
        })
        .catch(error => mostrarMensaje('Error al obtener tareas', 'danger'));
}

// Cambiar estado de tarea
function cambiarEstado(id, nuevoEstado) {
    axios.put(apiUrlmodificar, { id: id, estado: nuevoEstado })  // Sin ?id=...
        .then(response => {
            mostrarMensaje(`Tarea marcada como ${nuevoEstado}`);
            obtenerTareas();
        })
        .catch(error => {
            console.error('Error completo:', error.response?.data || error.message);
            mostrarMensaje('Error: ' + (error.response?.data?.message || error.message), 'danger');
        });
}



// Eliminar tarea
function eliminarTarea(id) {
    axios.delete(`${apiUrlborrar}?id=${id}`)  
        .then(() => {
            mostrarMensaje('Tarea eliminada');
            obtenerTareas();
        })
        .catch(error => mostrarMensaje('Error al eliminar tarea', 'danger'));
}

// Cargar tareas al inicio
window.onload = obtenerTareas;
