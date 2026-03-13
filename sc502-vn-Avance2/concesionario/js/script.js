// Espera a que el HTML cargue completamente
document.addEventListener("DOMContentLoaded", function () {
 
    // =========================
    // CLASE CLIENTE
    // =========================
    class Cliente {
        constructor(nombre, apellido, cedula, telefono, correo, direccion) {
            this.id = Date.now();
            this.nombre = nombre;
            this.apellido = apellido;
            this.cedula = cedula;
            this.telefono = telefono;
            this.correo = correo;
            this.direccion = direccion;
        }
    }
 
    // =========================
    // CLASE RESERVA
    // =========================
    class Reserva {
        constructor(nombre, correo, telefono, fecha, mensaje, vehiculo) {
            this.id = Date.now();
            this.nombre = nombre;
            this.correo = correo;
            this.telefono = telefono;
            this.fecha = fecha;
            this.mensaje = mensaje;
            this.vehiculo = vehiculo;
        }
    }
 
    // =========================
    // CLASE CONTACTO
    // =========================
    class Contacto {
        constructor(nombre, correo, asunto, mensaje) {
            this.id = Date.now();
            this.nombre = nombre;
            this.correo = correo;
            this.asunto = asunto;
            this.mensaje = mensaje;
        }
    }
 
    // =========================
    // FUNCIONES AUXILIARES
    // =========================
    function guardarEnLocalStorage(clave, datos) {
        localStorage.setItem(clave, JSON.stringify(datos));
    }
 
    function obtenerDeLocalStorage(clave) {
        return JSON.parse(localStorage.getItem(clave)) || [];
    }
 
    // =========================
    // FORMULARIO CLIENTES
    // =========================
    const formClientes = document.getElementById("formClientes");
 
    if (formClientes) {
        formClientes.addEventListener("submit", function (e) {
            e.preventDefault();
 
            const nombre = document.querySelector("input[name='nombre']");
            const apellido = document.querySelector("input[name='apellido']");
            const cedula = document.querySelector("input[name='cedula']");
            const telefono = document.querySelector("input[name='telefono']");
            const correo = document.querySelector("input[name='correo']");
            const direccion = document.querySelector("input[name='direccion']");
 
            if (!nombre || nombre.value.trim() === "") {
                alert("Debe ingresar el nombre");
                return;
            }
 
            if (!apellido || apellido.value.trim() === "") {
                alert("Debe ingresar el apellido");
                return;
            }
 
            if (!cedula || cedula.value.trim() === "") {
                alert("Debe ingresar la cédula");
                return;
            }
 
            if (!telefono || telefono.value.trim() === "") {
                alert("Debe ingresar el teléfono");
                return;
            }
 
            if (!correo || correo.value.trim() === "") {
                alert("Debe ingresar el correo");
                return;
            }
 
            if (!direccion || direccion.value.trim() === "") {
                alert("Debe ingresar la dirección");
                return;
            }
 
            const nuevoCliente = new Cliente(
                nombre.value.trim(),
                apellido.value.trim(),
                cedula.value.trim(),
                telefono.value.trim(),
                correo.value.trim(),
                direccion.value.trim()
            );
 
            const clientesGuardados = obtenerDeLocalStorage("clientes");
            clientesGuardados.push(nuevoCliente);
            guardarEnLocalStorage("clientes", clientesGuardados);
 
            alert("Cliente guardado correctamente");
            formClientes.reset();
            mostrarClientes();
        });
    }
 
    // =========================
    // MOSTRAR CLIENTES
    // =========================
    function mostrarClientes() {
        const listaClientes = document.getElementById("listaClientes");
        if (!listaClientes) return;
 
        const clientesGuardados = obtenerDeLocalStorage("clientes");
        listaClientes.innerHTML = "";
 
        clientesGuardados.forEach(cliente => {
            const div = document.createElement("div");
            div.classList.add("cliente-item");
            div.innerHTML = `
                <h3>${cliente.nombre} ${cliente.apellido}</h3>
                <p><strong>Cédula:</strong> ${cliente.cedula}</p>
                <p><strong>Teléfono:</strong> ${cliente.telefono}</p>
                <p><strong>Correo:</strong> ${cliente.correo}</p>
                <p><strong>Dirección:</strong> ${cliente.direccion}</p>
            `;
            listaClientes.appendChild(div);
        });
    }
 
    // =========================
    // FORMULARIO RESERVA
    // =========================
    const formReserva = document.getElementById("formReserva");
 
    if (formReserva) {
        formReserva.addEventListener("submit", function (e) {
            e.preventDefault();
 
            const nombre = document.querySelector("#formReserva input[name='nombre']");
            const correo = document.querySelector("#formReserva input[name='correo']");
            const telefono = document.querySelector("#formReserva input[name='telefono']");
            const fecha = document.querySelector("#formReserva input[name='fecha']");
            const mensaje = document.querySelector("#formReserva textarea[name='mensaje']");
            const vehiculoSeleccionado = localStorage.getItem("vehiculo_seleccionado") || "No especificado";
 
            if (!nombre || nombre.value.trim() === "") {
                alert("Debe ingresar el nombre");
                return;
            }
 
            if (!correo || correo.value.trim() === "") {
                alert("Debe ingresar el correo");
                return;
            }
 
            if (!telefono || telefono.value.trim() === "") {
                alert("Debe ingresar el teléfono");
                return;
            }
 
            if (!fecha || fecha.value.trim() === "") {
                alert("Debe seleccionar una fecha");
                return;
            }
 
            const nuevaReserva = new Reserva(
                nombre.value.trim(),
                correo.value.trim(),
                telefono.value.trim(),
                fecha.value,
                mensaje ? mensaje.value.trim() : "",
                vehiculoSeleccionado
            );
 
            const reservasGuardadas = obtenerDeLocalStorage("reservas");
            reservasGuardadas.push(nuevaReserva);
            guardarEnLocalStorage("reservas", reservasGuardadas);
 
            alert("Reserva enviada correctamente");
            formReserva.reset();
        });
    }
 
    // =========================
    // FORMULARIO CONTACTO
    // =========================
    const formContacto = document.getElementById("formContacto");
 
    if (formContacto) {
        formContacto.addEventListener("submit", function (e) {
            e.preventDefault();
 
            const nombre = document.querySelector("#formContacto input[name='nombre']");
            const correo = document.querySelector("#formContacto input[name='correo']");
            const asunto = document.querySelector("#formContacto input[name='asunto']");
            const mensaje = document.querySelector("#formContacto textarea[name='mensaje']");
 
            if (!nombre || nombre.value.trim() === "") {
                alert("Debe ingresar el nombre");
                return;
            }
 
            if (!correo || correo.value.trim() === "") {
                alert("Debe ingresar el correo");
                return;
            }
 
            if (!asunto || asunto.value.trim() === "") {
                alert("Debe ingresar el asunto");
                return;
            }
 
            if (!mensaje || mensaje.value.trim() === "") {
                alert("Debe ingresar el mensaje");
                return;
            }
 
            const nuevoContacto = new Contacto(
                nombre.value.trim(),
                correo.value.trim(),
                asunto.value.trim(),
                mensaje.value.trim()
            );
 
            const contactosGuardados = obtenerDeLocalStorage("contactos");
            contactosGuardados.push(nuevoContacto);
            guardarEnLocalStorage("contactos", contactosGuardados);
 
            alert("Mensaje enviado correctamente");
            formContacto.reset();
        });
    }
 
    // =========================
    // BOTONES RESERVAR
    // =========================
    const botonesReservar = document.querySelectorAll(".btn-reservar");
 
    botonesReservar.forEach(boton => {
        boton.addEventListener("click", function () {
            const idVehiculo = this.dataset.id;
            localStorage.setItem("vehiculo_seleccionado", idVehiculo);
            window.location.href = "reserva.html";
        });
    });
 
    // =========================
    // MOSTRAR VEHICULO SELECCIONADO
    // =========================
    const vehiculoSeleccionadoDiv = document.getElementById("vehiculoSeleccionado");
 
    if (vehiculoSeleccionadoDiv) {
        const vehiculo = localStorage.getItem("vehiculo_seleccionado");
 
        if (vehiculo) {
            vehiculoSeleccionadoDiv.innerHTML = `
                <h3>Vehículo seleccionado</h3>
                <p>ID del vehículo: ${vehiculo}</p>
            `;
        } else {
            vehiculoSeleccionadoDiv.innerHTML = `
                <h3>No hay vehículo seleccionado</h3>
            `;
        }
    }
 
    // =========================
    // MOSTRAR CLIENTES AL CARGAR
    // =========================
    mostrarClientes();
 
});