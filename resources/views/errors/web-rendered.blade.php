<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impostazioni Mancanti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        body {
            background-color: #212529; /* Grigio scuro */
            font-family: sans-serif;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100">

    <div class="max-w-md p-4 bg-white rounded shadow w-100">
        <div class="mb-4 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#ffc107" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
        </div>
        <h2 class="mb-4 text-2xl font-semibold text-center text-gray-800">Errore</h2>
        <p class="mb-4 text-center text-gray-600">{{ $main_text }}</p>
        <p class="mb-4 text-center text-gray-600"></p>

    </div>

</body>
</html>
