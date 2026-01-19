@props([
    'elem',           // El objeto (libro o evento)
    'tipo' => 'libro', // 'libro' o 'evento'
    'dobleTarjeta' => true // Si muestra la parte trasera
])

<div class="w-full max-w-sm mx-auto perspective mb-6">
    <div x-data="{ flipped: false }"
         class="relative w-full"
         : class="flipped && {{ $dobleTarjeta ? 'true' : 'false' }} ?  'rotate-y-180' : ''"
         @click. away="flipped = false"
         style="transform-style: preserve-3d; transition: transform 0.6s;">

        {{-- ==================== FRONT (PARTE FRONTAL) ==================== --}}
        <div class="absolute w-full h-full backface-hidden bg-white shadow-lg rounded-lg overflow-hidden flex flex-col">
            
            @if($tipo === 'libro')
                {{-- ===== HEADER TIPO INSTAGRAM ===== --}}
                <div class="p-4 flex items-center space-x-3 border-b">
                    @if($elem->usuarioComun)
                        {{-- Avatar generado automáticamente --}}
                        <img src="https://ui-avatars.com/api/? name={{ urlencode($elem->usuarioComun->nombre_usuario ??  'Usuario') }}&background=random&size=40"
                             alt="{{ $elem->usuarioComun->nombre_usuario ?? 'Usuario' }}"
                             class="w-10 h-10 rounded-full ring-2 ring-blue-500" />

                        <div class="flex flex-col flex-grow">
                            <span class="font-semibold text-gray-800">{{ $elem->usuarioComun->nombre_usuario ?? 'Usuario' }}</span>
                            <span class="text-xs text-gray-500">{{ $elem->created_at->diffForHumans() }}</span>
                        </div>
                    @else
                        <img src="https://ui-avatars.com/api/?name=Anonimo&background=cccccc&size=40"
                             alt="Anónimo"
                             class="w-10 h-10 rounded-full" />

                        <div class="flex flex-col flex-grow">
                            <span class="font-semibold text-gray-800">Anónimo</span>
                            <span class="text-xs text-gray-500">{{ $elem->created_at->diffForHumans() }}</span>
                        </div>
                    @endif
                </div>

                {{-- ===== IMAGEN DEL LIBRO (estilo post de Instagram) ===== --}}
                @if($elem->imagen_libro)
                    <div class="w-full aspect-square bg-gray-100">
                        <img src="{{ asset('storage/' . $elem->imagen_libro) }}" 
                             alt="{{ $elem->titulo_libro }}"
                             class="w-full h-full object-cover" />
                    </div>
                @else
                    <div class="w-full aspect-square bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                        <svg class="w-24 h-24 text-white opacity-80" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 4. 804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                        </svg>
                    </div>
                @endif
                
                {{-- ===== INFORMACIÓN BÁSICA (Título y Autor) ===== --}}
                <div class="p-4 flex flex-col space-y-2">
                    <h3 class="font-bold text-lg text-gray-800 line-clamp-2">
                        {{ $elem->titulo_libro }}
                    </h3>
                    
                    <p class="text-sm text-gray-600">
                        <span class="font-semibold">Autor: </span> {{ $elem->autor_libro }}
                    </p>
                    
                    {{-- ===== BOTÓN MÁS DETALLES ===== --}}
                    <button @click.stop="flipped = true"
                            class="bg-blue-600 hover: bg-blue-700 text-white font-semibold py-2 px-5 rounded-lg shadow mt-2 w-full transition-colors">
                        Más detalles
                    </button>
                </div>

            @elseif($tipo === 'evento')
                {{-- ===== FRONT DE EVENTO (sin cambios mayores) ===== --}}
                <div class="p-4 flex items-center space-x-3 border-b">
                    @if($elem->usuarioComun)
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($elem->usuarioComun->nombre_usuario ??  'Usuario') }}&background=random&size=40"
                             alt="{{ $elem->usuarioComun->nombre_usuario ?? 'Usuario' }}"
                             class="w-10 h-10 rounded-full ring-2 ring-purple-500" />

                        <div class="flex flex-col flex-grow">
                            <span class="font-semibold text-gray-800">{{ $elem->usuarioComun->nombre_usuario ?? 'Usuario' }}</span>
                            <span class="text-xs text-gray-500">{{ $elem->created_at->diffForHumans() }}</span>
                        </div>
                    @else
                        <img src="https://ui-avatars.com/api/?name=Anonimo&background=cccccc&size=40"
                             alt="Anónimo"
                             class="w-10 h-10 rounded-full" />

                        <div class="flex flex-col flex-grow">
                            <span class="font-semibold text-gray-800">Anónimo</span>
                            <span class="text-xs text-gray-500">{{ $elem->created_at->diffForHumans() }}</span>
                        </div>
                    @endif
                    
                    <span class="bg-purple-100 text-purple-800 text-xs font-bold px-3 py-1 rounded-full">
                        EVENTO
                    </span>
                </div>

                @if($elem->imagen_evento)
                    <div class="w-full aspect-square bg-gray-100">
                        <img src="{{ asset('storage/' . $elem->imagen_evento) }}" 
                             alt="{{ $elem->titulo_evento }}"
                             class="w-full h-full object-cover" />
                    </div>
                @else
                    <div class="w-full aspect-square bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center">
                        <svg class="w-24 h-24 text-white opacity-80" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                @endif
                
                <div class="p-4 flex flex-col space-y-2">
                    <div class="flex items-center justify-between">
                        <h3 class="font-bold text-lg text-gray-800 line-clamp-2 flex-grow">
                            {{ $elem->titulo_evento }}
                        </h3>
                    </div>
                    
                    <div class="flex items-center space-x-2 text-sm text-gray-600">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ \Carbon\Carbon::parse($elem->fecha_evento)->format('d M Y') }}</span>
                    </div>

                    <div class="flex items-center space-x-2 text-sm text-gray-600">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5. 05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ $elem->ubicacion_evento ??  'Ubicación por confirmar' }}</span>
                    </div>

                    @if($elem->descripcion_evento)
                        <p class="text-sm text-gray-600 line-clamp-3 pt-2">
                            {{ $elem->descripcion_evento }}
                        </p>
                    @endif
                </div>
            @endif

        </div>

        {{-- ==================== BACK (PARTE TRASERA) - Solo para libros ==================== --}}
        @if($dobleTarjeta && $tipo === 'libro')
            <div class="absolute w-full h-full backface-hidden rotate-y-180 bg-white shadow-lg rounded-lg p-6 flex flex-col space-y-4">
                
                {{-- ===== TÍTULO DESTACADO ===== --}}
                <h3 class="font-bold text-xl text-gray-800 border-b-2 border-blue-500 pb-3">
                    {{ $elem->titulo_libro }}
                </h3>

                {{-- ===== INFORMACIÓN DETALLADA ===== --}}
                <div class="space-y-3 flex-grow overflow-y-auto">
                    
                    {{-- Autor --}}
                    <div class="bg-gray-50 rounded-lg p-3">
                        <span class="text-xs text-gray-500 uppercase tracking-wide">Autor</span>
                        <p class="text-gray-800 font-semibold">{{ $elem->autor_libro }}</p>
                    </div>

                    {{-- ISBN --}}
                    <div class="bg-gray-50 rounded-lg p-3">
                        <span class="text-xs text-gray-500 uppercase tracking-wide">ISBN</span>
                        <p class="text-gray-800 font-semibold">
                            @if($elem->ISBN)
                                {{ $elem->ISBN }}
                            @else
                                <span class="italic text-gray-400">No disponible</span>
                            @endif
                        </p>
                    </div>

                    {{-- Estado --}}
                    <div class="bg-gray-50 rounded-lg p-3">
                        <span class="text-xs text-gray-500 uppercase tracking-wide block mb-2">Estado</span>
                        <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full
                            @if($elem->estado_libro === 'nuevo') bg-green-100 text-green-800
                            @elseif($elem->estado_libro === 'seminuevo') bg-blue-100 text-blue-800
                            @elseif($elem->estado_libro === 'usado') bg-yellow-100 text-yellow-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ ucfirst($elem->estado_libro) }}
                        </span>
                    </div>

                    {{-- Género (opcional) --}}
                    <div class="bg-gray-50 rounded-lg p-3">
                        <span class="text-xs text-gray-500 uppercase tracking-wide">Género</span>
                        <p class="text-gray-800 font-semibold">
                            @if($elem->genero_libro)
                                {{ $elem->genero_libro }}
                            @else
                                <span class="italic text-gray-400">No disponible</span>
                            @endif
                        </p>
                    </div>

                    {{-- Fecha de publicación --}}
                    <div class="bg-gray-50 rounded-lg p-3">
                        <span class="text-xs text-gray-500 uppercase tracking-wide">Fecha de publicación</span>
                        <p class="text-gray-800 font-semibold">
                            @if($elem->fecha_publicacion_libro)
                                {{ \Carbon\Carbon::parse($elem->fecha_publicacion_libro)->format('d/m/Y') }}
                            @else
                                <span class="italic text-gray-400">No disponible</span>
                            @endif
                        </p>
                    </div>

                    {{-- Propietario --}}
                    <div class="bg-blue-50 rounded-lg p-3">
                        <span class="text-xs text-blue-600 uppercase tracking-wide block mb-2">Propietario</span>
                        @if($elem->usuarioComun)
                            <div class="flex items-center space-x-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($elem->usuarioComun->nombre_usuario ?? 'Usuario') }}&background=random&size=40"
                                     alt="{{ $elem->usuarioComun->nombre_usuario ?? 'Usuario' }}"
                                     class="w-10 h-10 rounded-full ring-2 ring-blue-400" />
                                <span class="text-gray-800 font-semibold">{{ $elem->usuarioComun->nombre_usuario ?? 'Usuario' }}</span>
                            </div>
                        @else
                            <span class="italic text-gray-400">No disponible</span>
                        @endif
                    </div>

                </div>

                {{-- ===== BOTONES PERSONALIZADOS + VOLVER ===== --}}
                <div class="space-y-2 pt-4 border-t">
                    {{ $slot }}
                    
                    <button @click.stop="flipped = false"
                            class="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 px-5 rounded-lg shadow w-full transition-colors">
                        Volver
                    </button>
                </div>
            </div>
        @endif

    </div>
</div>

<style>
    .perspective {
        perspective: 1000px;
    }
    . rotate-y-180 {
        transform:  rotateY(180deg);
    }
    .backface-hidden {
        backface-visibility: hidden;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp:  2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .aspect-square {
        aspect-ratio: 1 / 1;
    }
</style>