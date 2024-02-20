<!DOCTYPE html>
    <html lang='en'>
     <head>
     <meta charset='UTF-8'>
     <meta name='viewport' content='width=device-width, initial-scale=1.0'>
     <title>Plantilla de Correo Electrónico</title>
     <link rel='stylesheet' href='../css/bootstrap.min.css'>
                    <style>

                    body {
                      font-family: Arial, sans-serif;
                      margin: 0;
                      padding: 0;
                    }

                    .logo{
                        width: 110px;
                        height: 110px;
                        border-radius: 50%;
                        border: 2.5px solid #007AB6;
                        position: absolute;
                        top: 100px;
                        left: calc(50% - 50px);
                        margin-top: -50px;
                        margin-bottom: 35px;
                    }

                    .container {
                      width: 100%;
                      max-width: 600px;
                      margin: 0 auto;
                      padding: 20px;
                    }

                    .header {
                      background-color: #3498db; 
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
                      background-color: #f4f4f4;
                    }

                    .footer {
                      text-align: center;
                      padding-top: 20px;
                    }
    </style>
                </head>
                <body>
    <div class='container'>
    <img src="../imagenes/logocorporativo.png" alt="" class="logo">
        <div class='header'>
    <h1>Bienvenido</h1>
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
                    ";