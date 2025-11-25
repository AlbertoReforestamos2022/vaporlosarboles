document.addEventListener('DOMContentLoaded', function() {
    // Agregar tamaño del contenenor (mapa - cards de busqueda)
    // #directorio_content
    const observer = new ResizeObserver(entries => {
        for (let entry of entries ) {
            const { height } = entry.contentRect;
            console.log(`Elemento ${height}`); 
        }
    })

    observer.observe(document.querySelector('body')); 
    
    // ========== VARIABLES GLOBALES ==========
    let todosLosEspecialistas = [];
    let estadosGeoJSON = null;
    let currentStateLayer = null;
    let estadosConEspecialistas = new Set();
    
    // Objeto para rastrear filtros activos
    let filtroActivo = {
        estado: '',
        especialidad: ''
    };

    // ========== INICIALIZAR MAPA ==========
    let map = L.map('map').setView([23.6345, -102.5528], 5);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 15,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // ========== BOTÓN VISTA GENERAL ==========
    const overviewButton = L.control({position: "topright"});

    overviewButton.onAdd = function(map) {
        const contenedorBtn = L.DomUtil.create("div", "custom-button");
        contenedorBtn.innerHTML = `
            <div class="col">
                <button class="w-100 btn btn-success" style="border-radius: 50px;" id="overviewMap">Vista general</button>
            </div>
        `;
        return contenedorBtn;
    };

    overviewButton.addTo(map);

    setTimeout(() => {
        const overviewMapBtn = document.getElementById("overviewMap");
        if (overviewMapBtn) {
            overviewMapBtn.addEventListener("click", () => {
                const defaultCoords = [23.6345, -102.5528];
                const defaultZoom = 5;
                map.setView(defaultCoords, defaultZoom);
                
                // Resetear filtros
                filtroActivo.estado = '';
                filtroActivo.especialidad = '';
                
                // Resetear selects
                document.querySelector('#states-option').value = "";
                document.querySelector('#speciality-option').value = "";
                
                // Limpiar cards y mostrar mensaje inicial
                mostrarMensajeInicial();
                
                // Quitar resaltado
                if (currentStateLayer) {
                    map.removeLayer(currentStateLayer);
                    currentStateLayer = null;
                }
            });
        }
    }, 0);

    // ========== PROYECCIONES ==========
    const sourceProjection = "+proj=lcc +lat_0=12 +lon_0=-102 +lat_1=17.5 +lat_2=29.5 +x_0=2500000 +y_0=0 +datum=WGS84 +units=m +no_defs";
    const targetProjection = "EPSG:4326";

    function transformCoords(coords) {
        return coords.map(poly =>
            poly.map(ring =>
                ring.map(coord => proj4(sourceProjection, targetProjection, coord))
            )
        );
    }

    // ========== CARGAR GEOJSON DE ESTADOS ==========
    console.log('Cargando GeoJSON de estados...');
    
    fetch(especialistasData.estadosJsonUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al cargar: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('GeoJSON cargado correctamente');
            estadosGeoJSON = data;
            
            // Transformar coordenadas
            data.features.forEach(feature => {
                if (feature.geometry.type === "MultiPolygon") {
                    feature.geometry.coordinates = transformCoords(feature.geometry.coordinates);
                } else if (feature.geometry.type === "Polygon") {
                    feature.geometry.coordinates = transformCoords([feature.geometry.coordinates])[0];
                }
            });

            // Agregar todos los estados al mapa (sin resaltar)
            L.geoJSON(data, {
                style: {
                    color: "rgba(150, 150, 150, 0.5)",
                    weight: 1,
                    fillOpacity: 0.1
                }
            }).addTo(map);

            // Llenar el select de estados
            llenarSelectEstados(data);
        })
        .catch(error => {
            console.error('Error al cargar el GeoJSON:', error);
            alert('Error al cargar el mapa de estados. Verifica la consola.');
        });

    // ========== LLENAR SELECT DE ESTADOS ==========
    function llenarSelectEstados(geoData) {
        const select = document.querySelector('#states-option');
        
        if (!select) {
            console.error('❌ No se encontró el select #states-option');
            return;
        }
        
        select.innerHTML = '';
        
        const defaultOption = document.createElement("option");
        defaultOption.value = "";
        defaultOption.textContent = "Estado";
        select.appendChild(defaultOption);

        const estadosOrdenados = geoData.features
            .map(f => ({
                clave: f.properties.CVE_ENT,
                nombre: f.properties.NOM_ENT
            }))
            .sort((a, b) => a.nombre.localeCompare(b.nombre));

        estadosOrdenados.forEach(estado => {
            const option = document.createElement("option");
            option.value = estado.clave;
            option.textContent = estado.nombre;
            select.appendChild(option);
        });
        
        console.log('✅ Select de estados llenado con', estadosOrdenados.length, 'opciones');
    }

    // ========== LLENAR SELECT DE ESPECIALIDAD ============ 
    function llenarSelectEspecialidad() {
        const select = document.querySelector('#speciality-option'); 
        
        if (!select) {
            console.error('No se encontró el select #speciality-option');
            return;
        }
        
        select.innerHTML = ''; 

        // Opción por defecto
        const defaultOption = document.createElement("option"); 
        defaultOption.value = ""; 
        defaultOption.textContent = "Especialidad"; 
        select.appendChild(defaultOption); 

        // Extraer especialidades únicas del array de especialistas
        const especialidadesMap = new Map();
        
        todosLosEspecialistas.forEach(esp => {
            // Solo agregar si tiene especialidad
            if (esp.especialidad_clave && esp.especialidad) {
                // Usar Map para evitar duplicados
                especialidadesMap.set(esp.especialidad_clave, esp.especialidad);
            }
        });

        // Convertir Map a array y ordenar alfabéticamente por nombre
        const especialidadesOrdenadas = Array.from(especialidadesMap.entries())
            .sort((a, b) => a[1].localeCompare(b[1])); // Ordenar por nombre [1]

        console.log('✅ Especialidades encontradas:', especialidadesOrdenadas);

        // Crear opciones
        especialidadesOrdenadas.forEach(([clave, nombre]) => {
            const option = document.createElement("option"); 
            option.value = clave;
            option.textContent = nombre;
            select.appendChild(option);
        });
        
        console.log(`Select de especialidades llenado con ${especialidadesOrdenadas.length} opciones`);
    }

    // ========== MOSTRAR MENSAJE INICIAL ==========
    function mostrarMensajeInicial() {
        const contenedor = document.getElementById("instrucciones");

    }

    // ========== CARGAR ESPECIALISTAS DESDE WORDPRESS ==========
    function cargarEspecialistas() {
        console.log('Cargando especialistas desde WordPress...');
        
        jQuery.ajax({
            url: especialistasData.ajaxUrl,
            type: 'POST',
            data: {
                action: 'obtener_datos_especialistas',
                nonce: especialistasData.nonce
            },
            success: function(response) {
                console.log('Respuesta AJAX recibida');
                
                if (response.success) {
                    todosLosEspecialistas = response.data;
                    console.log('Especialistas cargados:', todosLosEspecialistas);
                    
                    // Crear set de estados con especialistas
                    todosLosEspecialistas.forEach(esp => {
                        if (esp.lugar_clave) {
                            estadosConEspecialistas.add(esp.lugar_clave);
                        }
                    });
                    
                    console.log('Estados con especialistas:', Array.from(estadosConEspecialistas));
                    
                    // NO mostrar cards al inicio, solo mensaje
                    mostrarMensajeInicial();

                    // Llenar select de especialidades
                    llenarSelectEspecialidad();
                    
                } else {
                    console.error('Error en la respuesta:', response);
                    mostrarError('No se pudieron cargar los especialistas.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error AJAX:', {
                    status: status,
                    error: error,
                    responseText: xhr.responseText
                });
                mostrarError('Error de conexión. Por favor, recarga la página.');
            }
        });
    }

    // ========== MOSTRAR ERROR ==========
    function mostrarError(mensaje) {
        const contenedor = document.getElementById("directorio_cards");
        contenedor.innerHTML = `
            <div class="alert alert-danger m-3" role="alert">
                <strong>Error:</strong> ${mensaje}
            </div>
        `;
    }

    // ========== APLICAR FILTROS COMBINADOS ==========
    function aplicarFiltros() {
        const contenedor = document.getElementById("results-specialists");
        contenedor.innerHTML = '';

        // Resultados encontrados
        let resultadosEncontrados = document.getElementById("resultados_encontrados"); 
        // console.log(resultadosEncontrados); 
        resultadosEncontrados.innerHTML = ''; 

        let especialistasFiltrados = todosLosEspecialistas;

        // Filtrar por estado si está seleccionado
        if (filtroActivo.estado) {
            especialistasFiltrados = especialistasFiltrados.filter(
                esp => esp.lugar_clave === filtroActivo.estado
            );
        }

        // Filtrar por especialidad si está seleccionada
        if (filtroActivo.especialidad) {
            especialistasFiltrados = especialistasFiltrados.filter(
                esp => esp.especialidad_clave === filtroActivo.especialidad
            );
        }

        // Si no hay filtros activos, mostrar mensaje inicial
        if (!filtroActivo.estado && !filtroActivo.especialidad) {
            mostrarMensajeInicial();
            return;
        }

        console.log('Filtros aplicados:', filtroActivo);
        console.log('Resultados:', especialistasFiltrados.length);

        // Mostrar resultados o mensaje de "sin resultados"
        if (especialistasFiltrados.length === 0) {
            resultadosEncontrados.innerHTML = `
                <div class="alert alert-warning m-3" role="alert">
                    <strong>Sin resultados</strong><br>
                    No hay especialistas que coincidan con los filtros seleccionados.
                </div>
            `;
            return;
        }

        // Crear cards
        const containerResults = document.createElement('div');
        containerResults.classList.add('row', 'justify-content-center', 'bg-white', 'actions-content-map');
        containerResults.setAttribute('id', 'directorio_cards'); 

        especialistasFiltrados.forEach((especialista) => {
            const div = document.createElement("div");
            div.className = "especialista-card-wrapper";
            div.innerHTML = `
                <div class="col-12 d-grid align-items-center">
                    <div class="card border-0 mb-3 rounded shadow">
                        <div class="card-body p-3">
                            <h5 class="fw-semibold mb-2" style="font-size: 18px!important; color: #198754;">
                                ${especialista.nombre}
                            </h5>
                            ${especialista.especialidad ? `
                                <p class="mb-2">
                                    <span class="badge bg-success">${especialista.especialidad}</span>
                                </p>
                            ` : ''}
                            ${especialista.empresa ? `
                                <p class="mb-1 text-secondary">
                                    <strong>Empresa:</strong> ${especialista.empresa}
                                </p>
                            ` : ''}
                            ${especialista.telefono ? `
                                <p class="mb-1 text-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                                    </svg>
                                    <strong>Teléfono:</strong> <a href="tel:${especialista.telefono}"> ${especialista.telefono} </a>  
                                </p>
                            ` : ''}
                            ${especialista.correo ? `
                                <p class="mb-1 text-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                        <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z"/>
                                    </svg>
                                    <strong>Correo:</strong> <a href="mailto:${especialista.correo}">${especialista.correo}</a>
                                </p>
                            ` : ''}
                            ${especialista.lugar_nombre ? `
                                <p class="mb-1 text-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                                    </svg>
                                    <strong>Estado:</strong> ${especialista.lugar_nombre}
                                </p>
                            ` : ''}
                            ${especialista.actividades ? `
                                <p class="mb-0 mt-2">
                                    <strong>Actividades:</strong><br>
                                    <small class="text-muted">${especialista.actividades}</small>
                                </p>
                            ` : ''}
                        </div>
                    </div>
                </div>
            `;
            containerResults.appendChild(div);
        });

        contenedor.appendChild(containerResults); 

        // Mostrar contador - resultados 
        const contador = document.createElement("div");
        contador.className = "alert alert-success m-3";
        contador.innerHTML = `
            <strong>${especialistasFiltrados.length}</strong> especialista${especialistasFiltrados.length !== 1 ? 's' : ''} encontrado${especialistasFiltrados.length !== 1 ? 's' : ''}.
        `;

        resultadosEncontrados.appendChild(contador); 
    }

    // ========== RESALTAR ESTADO EN EL MAPA ==========
    function resaltarEstado(claveEstado) {
        // Quitar resaltado anterior
        if (currentStateLayer) {
            map.removeLayer(currentStateLayer);
        }

        if (!estadosGeoJSON) {
            console.warn('GeoJSON no cargado todavía');
            return;
        }

        // Buscar el estado en el GeoJSON
        const estadoFeature = estadosGeoJSON.features.find(
            f => f.properties.CVE_ENT === claveEstado
        );

        if (estadoFeature) {
            console.log('Resaltando estado:', estadoFeature.properties.NOM_ENT);
            
            // Crear nueva capa para el estado resaltado
            currentStateLayer = L.geoJSON(estadoFeature, {
                style: {
                    color: "rgba(33, 137, 30, 1)",
                    weight: 3,
                    fillOpacity: 0.3,
                    fillColor: "rgba(33, 137, 30, 0.2)"
                }
            }).addTo(map);

            // Hacer zoom al estado
            const bounds = currentStateLayer.getBounds();
            map.fitBounds(bounds, { padding: [50, 50] });
        } else {
            console.warn('Estado no encontrado en GeoJSON:', claveEstado);
        }
    }

    // ========== EVENT LISTENER PARA SELECT DE ESTADOS ==========
    document.querySelector('#states-option').addEventListener('change', function(e) {
        const claveEstado = e.target.value;
        console.log('Estado seleccionado:', claveEstado);
        
        filtroActivo.estado = claveEstado;
        
        if (claveEstado) {
            // Resaltar estado en el mapa
            resaltarEstado(claveEstado);
        } else {
            // Quitar resaltado
            if (currentStateLayer) {
                map.removeLayer(currentStateLayer);
                currentStateLayer = null;
            }
            
            // Volver a la vista general
            map.setView([23.6345, -102.5528], 5);
        }
        
        // Aplicar filtros
        aplicarFiltros();
    });

    // ========== EVENT LISTENER PARA SELECT DE ESPECIALIDAD ==========
    document.querySelector('#speciality-option').addEventListener('change', function(e) {
        const claveEspecialidad = e.target.value;
        console.log('Especialidad seleccionada:', claveEspecialidad);
        
        filtroActivo.especialidad = claveEspecialidad;
        
        // Aplicar filtros
        aplicarFiltros();
    });

    // ========== INICIALIZAR ==========
    cargarEspecialistas();

});