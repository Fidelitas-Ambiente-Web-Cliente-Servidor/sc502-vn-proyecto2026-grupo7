document.addEventListener("DOMContentLoaded", function () {

    // =========================
    // CLASES (POO para el proyecto)
    // =========================
    class Reserva {
        constructor(nombre, correo, telefono, fecha, vehiculo, mensaje) {
            this.id = Date.now();
            this.nombre = nombre;
            this.correo = correo;
            this.telefono = telefono;
            this.fecha = fecha;
            this.vehiculo = vehiculo;
            this.mensaje = mensaje;
        }
    }

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
    // LÓGICA DE RESERVA
    // =========================
    const formReserva = document.getElementById("formReserva");
    const infoVehiculo = document.getElementById("infoVehiculo");
    const textoVehiculo = document.getElementById("textoVehiculo");

    // Verificar si el usuario viene de elegir un carro en el inventario
    const vehiculoGuardado = localStorage.getItem("vehiculo_seleccionado");
    if (vehiculoGuardado && infoVehiculo) {
        infoVehiculo.style.display = "block";
        textoVehiculo.innerHTML = `<strong>Vehículo de interés:</strong> ${vehiculoGuardado}. Por favor, confirma los datos abajo.`;
        // Intentar pre-seleccionar en el dropdown
        const selectVehiculo = document.getElementById("vehiculo");
        if(selectVehiculo) selectVehiculo.value = vehiculoGuardado;
    }

    if (formReserva) {
        formReserva.addEventListener("submit", function (e) {
            e.preventDefault();

            const nuevaReserva = new Reserva(
                document.getElementById("nombre").value,
                document.getElementById("correo").value,
                document.getElementById("telefono").value,
                document.getElementById("fecha").value,
                document.getElementById("vehiculo").value,
                document.getElementById("mensaje").value
            );

            // Guardamos en LocalStorage (Requisito de la U)
            let reservas = JSON.parse(localStorage.getItem("mis_reservas")) || [];
            reservas.push(nuevaReserva);
            localStorage.setItem("mis_reservas", JSON.stringify(reservas));

            alert(`¡Gracias ${nuevaReserva.nombre}! Tu reserva para el ${nuevaReserva.vehiculo} ha sido registrada.`);
            localStorage.removeItem("vehiculo_seleccionado"); // Limpiar selección
            window.location.href = "index.php";
        });
    }

    // =========================
    // LÓGICA DE CONTACTO
    // =========================
    const formContacto = document.getElementById("formContacto");
    if (formContacto) {
        formContacto.addEventListener("submit", function (e) {
            e.preventDefault();
            
            const mensajeContacto = new Contacto(
                document.querySelector("input[name='nombre']").value,
                document.querySelector("input[name='correo']").value,
                document.querySelector("input[name='asunto']").value,
                document.querySelector("textarea[name='mensaje']").value
            );

            let contactos = JSON.parse(localStorage.getItem("mensajes_contacto")) || [];
            contactos.push(mensajeContacto);
            localStorage.setItem("mensajes_contacto", JSON.stringify(contactos));

            alert("Mensaje enviado con éxito. Nos pondremos en contacto pronto.");
            formContacto.reset();
        });
    }
});