<!-- resources/views/traductor.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traductor Kiché</title>
    @vite('resources/css/app.css')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-2xl mx-auto my-10 p-6 bg-white rounded-lg shadow-md">
        <div class="text-center mb-8 pb-4 border-b-2 border-green-500">
            <h1 class="text-2xl font-bold text-gray-800">Traductor Kiché</h1>
            <p class="text-gray-600 mt-2">Traduce texto entre español y kiché de forma rápida y sencilla</p>
        </div>
        
        <div class="space-y-6">
            <!-- Texto Original -->
            <div class="space-y-2">
                <div class="flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Texto original</span>
                    <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-xs font-semibold">Español</span>
                </div>
                <textarea 
                    id="source-text" 
                    class="w-full min-h-[150px] p-4 border border-gray-300 rounded resize-y focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                    placeholder="Escribe aquí el texto que deseas traducir..."></textarea>
                <div class="flex gap-3">
                    <button id="copy-source" class="text-green-600 text-sm hover:underline">Copiar</button>
                    <button id="clear-source" class="text-green-600 text-sm hover:underline">Limpiar</button>
                </div>
            </div>
            
            <!-- Texto Traducido -->
            <div class="space-y-2">
                <div class="flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Traducción</span>
                    <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-xs font-semibold">Kiché</span>
                </div>
                <textarea 
                    id="target-text" 
                    class="w-full min-h-[150px] p-4 border border-gray-300 rounded resize-y bg-gray-50"
                    placeholder="La traducción aparecerá aquí..." 
                    readonly></textarea>
                <div class="flex gap-3">
                    <button id="copy-translation" class="text-green-600 text-sm hover:underline">Copiar</button>
                </div>
            </div>
            
            <!-- Indicador de carga -->
            <div id="loading" class="hidden text-center py-4">
                <div class="inline-block w-8 h-8 border-4 border-gray-200 border-t-green-500 rounded-full animate-spin"></div>
                <p class="mt-2 text-gray-600">Traduciendo...</p>
            </div>
            
            <!-- Botones -->
            <div class="flex justify-center gap-4 mt-6">
                <button id="translate-btn" class="bg-green-500 hover:bg-green-600 text-white py-2 px-6 rounded transition-colors">
                    Traducir
                </button>
                <button id="clear-all-btn" class="bg-red-500 hover:bg-red-600 text-white py-2 px-6 rounded transition-colors">
                    Limpiar todo
                </button>
                <a href="{{ route('testConection') }}">Test</a>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Traducir texto
            $('#translate-btn').click(function() {
                const sourceText = $('#source-text').val().trim();
                
                if (!sourceText) {
                    alert('Por favor, ingresa un texto para traducir.');
                    return;
                }
                
                // Mostrar animación de carga
                $('#loading').removeClass('hidden');
                
                // Enviar petición a la API
                $.ajax({
                    url: '{{ route("traducir") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        texto: sourceText
                    },
                    success: function(response) {
                        $('#target-text').val(response.traduccion);
                        $('#loading').addClass('hidden');
                    },
                    error: function() {
                        $('#target-text').val('Error en la traducción. Intenta nuevamente.');
                        $('#loading').addClass('hidden');
                    }
                });
            });
            
            // Copiar texto original
            $('#copy-source').click(function() {
                $('#source-text').select();
                document.execCommand('copy');
                alert('Texto copiado al portapapeles');
            });
            
            // Copiar traducción
            $('#copy-translation').click(function() {
                $('#target-text').select();
                document.execCommand('copy');
                alert('Traducción copiada al portapapeles');
            });
            
            // Limpiar texto original
            $('#clear-source').click(function() {
                $('#source-text').val('');
            });
            
            // Limpiar todo
            $('#clear-all-btn').click(function() {
                $('#source-text').val('');
                $('#target-text').val('');
            });
        });
    </script>
</body>
</html>