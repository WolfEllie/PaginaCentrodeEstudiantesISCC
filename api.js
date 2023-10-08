

// Función para obtener y mostrar los usuarios
function obtenerUsuarios() {
    fetch('api.php') // Reemplaza 'tu_archivo_php.php' con la ruta correcta a tu archivo PHP
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al obtener los usuarios');
            }
            return response.json();
        })
        .then(data => {
            // Obtener el contenedor de las cards
            const cardContainer = document.getElementById('card-container');

            // Crear una card para cada usuario
            data.forEach(usuario => {
                const card = document.createElement('div');
                card.classList.add('card');
                card.innerHTML = `
                <div class="col">
                <div class="card">
                  <img src="img/descarga.jpg" class="rounded mx-auto d-block" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">${usuario.nombre_y_apellido}</h5>
                       <p class="card-text"><b>${usuario.rango}</b></p>
             </div>
             </div>
              </div>

              `;

                

                // Agregar la card al contenedor
                cardContainer.appendChild(card);
            });
        })
        .catch(error => {
            console.error('Error al obtener la lista de usuarios:', error);
        });
}

// Llamar a la función para obtener usuarios al cargar la página
obtenerUsuarios();



