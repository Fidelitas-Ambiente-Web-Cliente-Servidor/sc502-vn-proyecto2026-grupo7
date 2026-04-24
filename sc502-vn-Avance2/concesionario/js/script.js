document.addEventListener("DOMContentLoaded", function () {

    // =========================
    // CLASES (POO)
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
    // LÓGICA DE CONTACTO
    // =========================
    const formContacto = document.getElementById("formContacto");

    if (formContacto) {
        formContacto.addEventListener("submit", function (e) {
            e.preventDefault(); // DETIENE EL REFRESCADO DE PÁGINA

            // Captura de datos
            const nombre = document.getElementById("c_nombre").value;
            const correo = document.getElementById("c_email").value;
            const asunto = document.getElementById("c_asunto").value;
            const mensaje = document.getElementById("c_mensaje").value;

            // Creación del Objeto (POO)
            const nuevoMensaje = new Contacto(nombre, correo, asunto, mensaje);

            // Guardar en LocalStorage
            let mensajesGuardados = JSON.parse(localStorage.getItem("mensajes_contacto")) || [];
            mensajesGuardados.push(nuevoMensaje);
            localStorage.setItem("mensajes_contacto", JSON.stringify(mensajesGuardados));

            // Feedback al usuario
            alert(`¡Gracias ${nuevoMensaje.nombre}! Tu mensaje sobre "${nuevoMensaje.asunto}" ha sido enviado correctamente.`);
            
            // Limpiar formulario
            formContacto.reset();
        });
    }

    // =========================
    // LÓGICA DE RESERVA
    // =========================
    const formReserva = document.getElementById("formReserva");
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

            let reservas = JSON.parse(localStorage.getItem("mis_reservas")) || [];
            reservas.push(nuevaReserva);
            localStorage.setItem("mis_reservas", JSON.stringify(reservas));

            alert("Reserva confirmada. Nos vemos pronto.");
            window.location.href = "index.php";
        });
    }
});