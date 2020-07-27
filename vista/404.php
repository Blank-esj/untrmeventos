<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Error</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            line-height: 1.2;
            margin: 0;
        }

        html {
            color: #888;
            display: table;
            font-family: sans-serif;
            height: 100%;
            text-align: center;
            width: 100%;
        }

        body {
            display: table-cell;
            vertical-align: middle;
            margin: 2em auto;
            background-color: rgba(229, 232, 233, 0.55);
        }

        h1 {
            color: #555;
            font-size: 2em;
            font-weight: 400;
            text-transform: uppercase;
            font-weight: bold;
        }

        p {
            margin: 0 auto;
            width: 280px;
        }

        a {
            color: #fe4918;
        }

        @media only screen and (max-width: 280px) {

            body,
            p {
                width: 95%;
            }

            h1 {
                font-size: 1.5em;
                margin: 0 0 0.3em;
                text-transform: uppercase;
            }

        }
    </style>
</head>

<body>
    <h1>Página No Encontrada</h1>
    <img src="//localhost:8080/untrmeventos/vista/assets/img/logo.svg" alt="untrmeventos">
    <p><a href="/untrmeventos"> Regresar al sitio </a></p>
</body>

</html>
<!-- IE needs 512+ bytes: https://blogs.msdn.microsoft.com/ieinternals/2010/08/18/friendly-http-error-pages/ -->