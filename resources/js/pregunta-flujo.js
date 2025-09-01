document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form[action*="pregunta.responder"]');
    if (!form) return;

    const btnEnviar = form.querySelector('button[type="submit"]');
    const btnSiguiente = document.getElementById('btnSiguiente');
    const resultadoDiv = document.getElementById('resultadoAjax');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        fetch(form.action, {
            method: 'POST',
            body: new FormData(form),
            headers: {
                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            btnEnviar.classList.add('d-none');
            btnSiguiente.classList.remove('d-none');
            if (resultadoDiv && data.mensaje) {
                resultadoDiv.innerHTML = `<div class="alert ${data.resultado === 'correcto' ? 'alert-success' : 'alert-danger'} mt-3">${data.mensaje}</div>`;
            }
        });
    });
});