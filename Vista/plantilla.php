<!DOCTYPE html>
    <html lang='en'>
     <head>
     <meta charset='UTF-8'>
     <meta name='viewport' content='width=device-width, initial-scale=1.0'>
     <title>Plantilla de Correo Electrónico</title>
     <link rel='stylesheet' href='../css/bootstrap.min.css'>
                    <style>

                    body {
                      background: #007AB6;
                      font-family: Arial, sans-serif;
                      margin: 0;
                      padding: 0;
                    }

                    .container {
                      width: 100%;
                      max-width: 600px;
                      margin: 0 auto;
                      padding: 20px;
                    }

                    .header {
                      background: white;
                      padding: 20px; 
                      color: black; 
                      text-align: center; 
                    }

                    .header img {
                      max-width: 100%;
                      height: auto;
                    }

                    .content {
                      padding: 20px;
                      background-color: white;
                    }

                    .footer {
                      text-align: center;
                      padding-top: 20px;
                    }
    </style>
                </head>
                <body>
    <div class='container'>
        <div class='header'>
    <h1>Bienvenido</h1>
    <p><span style="font-size: 18px;">
    <a class="btn btn-primary" href="http://'.$link.'/srcv01/Vista/ejemplovrc.php" style="display: inline-block; padding: 10px 20px; background-color: #007AB6; color: #ffffff; text-decoration: none; border-radius: 4px;">
    Ingresa aquí</a></p>'
    </div>
        
        <!-- Contenido -->
        <div class='content'>
            <p>Hola [Nombre],</p>
            <p>Se ha detectado que usted cambio la contraseña.</p>
            <p>Se ha confirmado que se cambio correctamente.</p>
            <p>Atentamente,<br>iT-Global</p>
        </div>
        
        <!-- Pie de página -->
        <div class='footer'>
        </div>
    </div>
                </body>
    </html>
                    ';