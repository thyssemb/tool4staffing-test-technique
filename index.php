<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tool4cars</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>

    <div class="client-switcher">
        <button data-client="clienta">Client A</button>
        <button data-client="clientb">Client B</button>
        <button data-client="clientc">Client C</button>
    </div>

    <div id="module-nav" style="display:none;">
        <button data-module="cars">Voitures</button>
        <button data-module="garage">Garages</button>
    </div>

    <div class="dynamic-div" data-module="cars" data-script="ajax"></div>

    <script src="assets/js/app.js"></script>

</body>
</html>