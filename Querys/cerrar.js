function verificarCredenciales() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    if (username === 'Ecocampus' && password === 'Alula_2023') {
        document.getElementById('loginForm').style.display = 'none';
        document.getElementById('mensajeForm').style.display = 'block';
    } else {
        alert('Credenciales incorrectas. Inténtelo de nuevo.');
    }
}

function enviarMensajeWhatsApp() {
    const mensaje = encodeURIComponent('Hola, por favor revisar el sistema y cerrar la válvula, muchas gracias.');
    const numeroWhatsApp = '+573106021471';

    const url = `https://wa.me/${numeroWhatsApp}?text=${mensaje}`;

    window.open(url, '_blank');
}

function enviarDownlink() {
    const applicationID = 'nodo1otaa';
    const deviceID = 'eui-70b3d57ed0061b2a';
    const apiKey = 'NNSXS.SVGX5QS7H5XM3WQDXZLT6RZOLJVFCGCNO2WM2GA.SLG2DXY3S3BS4RZ2TRY3EWVFYPKJ2NJQ5V6JVWTBGBS73IQL5F7Q';
    const webhook_id = 'nodo1otaa';

    const payload = '1';  // Payload que quieres enviar al dispositivo

    const requestOptions = {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${apiKey}`,
      },
      body: JSON.stringify({
        formatters: {
          'cayenne': true
        },
        correlation_ids: [],
        device_ids: {
          application_ids: {
            application_id: applicationID
          },
          device_id: deviceID
        },
        downlink: {
          frm_payload: payload,
          priority: 'HIGH'
        }
      })
    };

    fetch(`https://nam1.cloud.thethings.network/api/v3/as/applications/${applicationID}/webhooks/${webhook_id}/devices/${deviceID}/down/push`, requestOptions)
      .then(response => response.json())
      .then(data => {
        console.log('Downlink enviado con éxito:', data);
      })
      .catch(error => {
        console.error('Error al enviar el downlink:', error);
      });
  }