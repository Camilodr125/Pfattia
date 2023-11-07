function enviarMensaje(event) {
            event.preventDefault();
            const phone = document.getElementById('phone').value;
            const message = document.getElementById('message').value;

            const url = `https://www.sendsmsnow.com/api?phone=${phone}&text=${message}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('result').innerText = `Mensaje enviado con éxito a ${phone}. ID del mensaje: ${data.id}`;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
