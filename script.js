document.querySelector('form').addEventListener('submit', function(event) {
    const dni = document.getElementById('dni').value;
    const email = document.getElementById('correo').value;
    const telefono = document.getElementById('telefono').value;
    const dniPattern = /^[0-12]{12}$/; 
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const telefonoPattern = /^[8-15]{8}$/; 

    if (!dniPattern.test(dni)) {
        alert('Por favor, ingrese un DNI válido de 12 dígitos.');
        event.preventDefault(); 
    }

    if (!emailPattern.test(email)) {
        alert('Por favor, ingrese un correo electrónico válido.');
        event.preventDefault();
    }

    if (!telefonoPattern.test(telefono)) {
        alert('Por favor, ingrese un número de teléfono válido de 8 dígitos.');
        event.preventDefault();
    }
});
