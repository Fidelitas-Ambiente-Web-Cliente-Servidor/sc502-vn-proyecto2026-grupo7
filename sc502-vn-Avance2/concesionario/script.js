document.addEventListener("DOMContentLoaded", function () {
    console.log("✅ Script vinculado correctamente.");

    // --- CLASES (POO) ---
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

    // --- MANEJO DE RESERVAS ---
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
            let datos = JSON.parse(localStorage.getItem("mis_reservas")) || [];
            datos.push(nuevaReserva);
            localStorage.setItem("mis_reservas", JSON.stringify(datos));
            alert("¡Reserva guardada con éxito!");
            formReserva.reset();
        });
    }

    // --- MANEJO DE CONTACTO ---
    const formContacto = document.getElementById("formContacto");
    if (formContacto) {
        formContacto.addEventListener("submit", function (e) {
            e.preventDefault();
            const nuevoContacto = new Contacto(
                document.getElementById("c_nombre").value,
                document.getElementById("c_email").value,
                document.getElementById("c_asunto").value,
                document.getElementById("c_mensaje").value
            );
            let datos = JSON.parse(localStorage.getItem("mensajes_contacto")) || [];
            datos.push(nuevoContacto);
            localStorage.setItem("mensajes_contacto", JSON.stringify(datos));
            alert("¡Mensaje de contacto guardado!");
            formContacto.reset();
        });
    }
});