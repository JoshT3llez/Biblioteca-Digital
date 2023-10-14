document.addEventListener("DOMContentLoaded", function () {
    const uploadForm = document.querySelector('form');

    uploadForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(uploadForm);

        try {
            const response = await fetch(uploadForm.action, {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                showAlert('Archivo subido exitosamente', 'success');
                uploadForm.reset();
            } else {
                showAlert('Hubo un error al subir el archivo', 'error');
            }
        } catch (error) {
            showAlert('Hubo un error al subir el archivo', 'error');
        }
    });

    function showAlert(message, type) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type}`;
        alertDiv.innerText = message;
        document.body.appendChild(alertDiv);
        setTimeout(() => {
            alertDiv.remove();
        }, 3000);
    }
});
