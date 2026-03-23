<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tool4cars</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: '#1B2B4B',
                        brand: '#FF5A36',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-gray-50 min-h-screen">

    <!-- Header -->
    <header class="bg-navy shadow-md">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
            <h1 class="text-white text-xl  font-bold tracking-wide">Tool4cars</h1>

            <!-- Client switcher -->
            <div class="flex gap-2">
                <button data-client="clienta" class="client-btn ...">Client A</button>
                <button data-client="clientb" class="client-btn ...">Client B</button>
                <button data-client="clientc" class="client-btn ...">Client C</button>
            </div>
        </div>
    </header>

    <!-- Module nav (Client B uniquement) -->
    <div id="module-nav" class="hidden bg-white border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-6 py-3 flex gap-4">
            <button data-module="cars" class="module-btn ...">Voitures</button>
            <button data-module="garages" class="module-btn ...">Garages</button>
        </div>
    </div>

    <!-- Contenu dynamique -->
    <main class="max-w-6xl mx-auto px-6 py-8">
        <div class="dynamic-div"></div>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>