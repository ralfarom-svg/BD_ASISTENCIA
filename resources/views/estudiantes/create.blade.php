@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8 font-sans">

    {{-- Contenedor Principal --}}
    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">

        {{-- Encabezado con Gradiente Naranja --}}
        <div class="bg-gradient-to-r from-orange-600 to-orange-500 p-8 text-white text-center relative overflow-hidden">
            {{-- Decoración de fondo sutil (opcional) --}}
            <div class="absolute top-0 left-0 w-full h-full bg-white opacity-5 transform -skew-x-12 origin-top-right"></div>

            <h1 class="text-3xl font-extrabold tracking-tight relative z-10">
                Registro de Estudiante
            </h1>
            <p class="mt-2 text-orange-100 text-sm relative z-10">
                Complete el formulario para inscribir a un nuevo alumno en el sistema.
            </p>
        </div>


        <div class="p-8 sm:p-12">
             {{-- Alertas de Error --}}
            @if ($errors->any())
            <div class="mb-8 rounded-lg bg-red-50 p-4 text-sm text-red-500 border-l-4 border-red-500 shadow-sm animate-pulse-slow">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Se encontraron errores en el formulario:</h3>
                        <ul class="mt-2 list-disc list-inside text-red-700">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            {{-- FORMULARIO --}}
            <form action="{{ route('estudiantes.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-10">
                @csrf

                {{-- SECCIÓN 1: DATOS PERSONALES --}}
                <div>
                    <div class="flex items-center space-x-2 mb-6 pb-2 border-b border-orange-100">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                          </svg>
                        <h2 class="text-xl font-bold text-gray-800">
                            Datos Personales
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">

                        <div class="col-span-1">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">DNI *</label>
                            <input name="dni" maxlength="8" type="text"
                                value="{{ old('dni') }}"
                                class="form-input w-full rounded-lg border-gray-300 shadow-sm h-12 px-4 focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50 transition duration-200 bg-white text-gray-700 placeholder-gray-400"
                                placeholder="Ingrese 8 dígitos">
                        </div>

                         <div class="col-span-1 md:col-start-1">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nombres *</label>
                            <input name="nombres" type="text"
                                value="{{ old('nombres') }}"
                                class="form-input w-full rounded-lg border-gray-300 shadow-sm h-12 px-4 focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50 transition duration-200 bg-white text-gray-700"
                                placeholder="Luz María">
                            
                            </div>

                        <div class="col-span-1">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Apellidos *</label>
                            <input name="apellidos" type="text"
                                value="{{ old('apellidos') }}"
                                class="form-input w-full rounded-lg border-gray-300 shadow-sm h-12 px-4 focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50 transition duration-200 bg-white text-gray-700"
                                placeholder="Centeno Martinez">
                        </div>

                        <div class="col-span-1">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Edad *</label>
                            <input type="number" name="edad"
                                value="{{ old('edad') }}"
                                class="form-input w-full rounded-lg border-gray-300 shadow-sm h-12 px-4 focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50 transition duration-200 bg-white text-gray-700"
                                placeholder="14">
                        </div>

                        <div class="col-span-1">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Género *</label>
                            <select name="genero"
                                class="form-select w-full rounded-lg border-gray-300 shadow-sm h-12 px-4 focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50 transition duration-200 bg-white text-gray-700">
                                <option value="">Seleccionar opción...</option>
                                <option value="Masculino" {{ old('genero') == 'M' ? 'selected' : '' }}>Masculino</option>
                                <option value="Femenino" {{ old('genero') == 'F' ? 'selected' : '' }}>Femenino</option>
                            </select>
                        </div>

                        <div class="col-span-1">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Teléfono de Contacto *</label>
                            <input name="telefono" maxlength="9" type="tel"
                                value="{{ old('telefono') }}"
                                class="form-input w-full rounded-lg border-gray-300 shadow-sm h-12 px-4 focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50 transition duration-200 bg-white text-gray-700"
                                placeholder="Ej: 999888777">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Distrito de Residencia *</label>
                            <select name="id_distrito"
                                class="form-select w-full rounded-lg border-gray-300 shadow-sm h-12 px-4 focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50 transition duration-200 bg-white text-gray-700">
                                <option value="">Seleccionar distrito...</option>
                                @foreach($distritos as $d)
                                <option value="{{ $d->id_distrito }}"
                                    {{ old('id_distrito') == $d->id_distrito ? 'selected' : '' }}>
                                    {{ $d->nombre_distrito }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Dirección Exacta *</label>
                            <textarea name="direccion" rows="3"
                                class="form-textarea w-full rounded-lg border-gray-300 shadow-sm p-4 focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50 transition duration-200 bg-white text-gray-700 resize-none" placeholder="Av. Principal #123, Urb. Las Flores...">{{ old('direccion') }}</textarea>
                        </div>
                    </div>
                </div>


                {{-- SECCIÓN 2: FOTOGRAFÍA (Rediseñado moderno) --}}
                <div>
                    <div class="flex items-center space-x-2 mb-6 pb-2 border-b border-orange-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <h2 class="text-xl font-bold text-gray-800">
                            Fotografía del Estudiante
                        </h2>
                    </div>

                    <div class="w-full">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Subir Imagen <span class="text-gray-500 font-normal">(Formatos: JPG, PNG, WEBP - Máx. 2MB)</span></label>

                        {{-- Área de carga moderna --}}
                        <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-orange-400 hover:bg-orange-50 transition-all group cursor-pointer relative" id="dropzone-container">
                            <div class="space-y-2 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-orange-500 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="text-sm text-gray-600">
                                    <label for="foto" class="relative cursor-pointer bg-white rounded-md font-medium text-orange-600 hover:text-orange-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-orange-500">
                                        <span>Selecciona un archivo</span>
                                        <input id="foto" name="foto" type="file" class="sr-only">
                                    </label>
                                    <span class="pl-1">o arrástralo aquí</span>
                                </div>
                                <p class="text-xs text-gray-500" id="file-name">Ningún archivo seleccionado aún</p>
                                <p id="file-error" class="text-xs text-red-600 font-medium hidden mt-2"></p>
                            </div>
                             {{-- Vista previa superpuesta (opcional, pero mejor ponerla abajo) --}}
                        </div>

                         {{-- Vista previa de imagen debajo del área de carga --}}
                        <div id="preview-container" class="hidden mt-6 text-center bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <p class="text-sm text-gray-600 mb-3 font-medium">Vista previa:</p>
                            <img id="preview-image" src="" class="mx-auto h-40 w-40 object-cover rounded-full border-4 border-white shadow-md">
                        </div>
                    </div>
                </div>


                {{-- SECCIÓN 3: DATOS ACADÉMICOS --}}
                <div>
                    <div class="flex items-center space-x-2 mb-6 pb-2 border-b border-orange-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                        </svg>
                        <h2 class="text-xl font-bold text-gray-800">
                            Datos Académicos
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- GRADO -->
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">
            Grado a Cursar *
        </label>
        <select name="grado"
            class="w-full rounded-lg border border-gray-300 shadow-sm h-12 px-4
                   bg-white text-gray-700
                   focus:outline-none focus:border-orange-500
                   focus:ring-2 focus:ring-orange-200 transition">
            <option value="">Seleccionar grado...</option>
            <option value="Primero" {{ old('grado') == 'Primero' ? 'selected' : '' }}>Primero</option>
            <option value="Segundo" {{ old('grado') == 'Segundo' ? 'selected' : '' }}>Segundo</option>
            <option value="Tercero" {{ old('grado') == 'Tercero' ? 'selected' : '' }}>Tercero</option>
            <option value="Cuarto" {{ old('grado') == 'Cuarto' ? 'selected' : '' }}>Cuarto</option>
            <option value="Quinto" {{ old('grado') == 'Quinto' ? 'selected' : '' }}>Quinto</option>
        </select>
    </div>

    <!-- SECCIÓN -->
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">
            Sección Asignada *
        </label>
        <select name="seccion"
            class="w-full rounded-lg border border-gray-300 shadow-sm h-12 px-4
                   bg-white text-gray-700
                   focus:outline-none focus:border-orange-500
                   focus:ring-2 focus:ring-orange-200 transition">
            <option value="">Seleccionar sección...</option>
            <option value="A" {{ old('seccion') == 'A' ? 'selected' : '' }}>A</option>
            <option value="B" {{ old('seccion') == 'B' ? 'selected' : '' }}>B</option>
            <option value="C" {{ old('seccion') == 'C' ? 'selected' : '' }}>C</option>
            <option value="D" {{ old('seccion') == 'D' ? 'selected' : '' }}>D</option>
            <option value="E" {{ old('seccion') == 'E' ? 'selected' : '' }}>E</option>
            <option value="F" {{ old('seccion') == 'F' ? 'selected' : '' }}>F</option>
        </select>
    </div>

</div>

                </div>

                {{-- SECCIÓN 4: INFORMACIÓN MÉDICA --}}
                <div>
                     <div class="flex items-center space-x-2 mb-6 pb-2 border-b border-orange-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h2 class="text-xl font-bold text-gray-800">
                            Información Médica / Adicional
                        </h2>
                    </div>

                    <div class="bg-orange-50 p-5 rounded-xl border border-orange-200">
                        <label class="flex items-center gap-4 cursor-pointer group">
                            <div class="relative flex items-start">
                                 <input type="checkbox" name="discapacidad" value="1" id="discapacidad_check"
                                    {{ old('discapacidad') ? 'checked' : '' }}
                                    class="h-6 w-6 text-orange-600 border-gray-300 rounded focus:ring-orange-500 transition duration-150 ease-in-out cursor-pointer">
                            </div>
                            <div>
                                <span class="text-gray-800 font-semibold text-lg group-hover:text-orange-700 transition">¿Presenta alguna discapacidad o condición médica relevante?</span>
                                <p class="text-gray-500 text-sm mt-1">Marque esta casilla para detallar la condición.</p>
                            </div>
                        </label>
                    </div>


                    {{-- Sección Desplegable con Animación Suave --}}
                    <div id="tipo_discapacidad_section"
                        class="{{ old('discapacidad') ? 'max-h-[500px] opacity-100 mt-6' : 'max-h-0 opacity-0 mt-0' }} overflow-hidden transition-all duration-500 ease-in-out">

                        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                             <label class="block text-sm font-semibold text-gray-700 mb-3">Detalle el tipo de discapacidad o condición médica *</label>
                            <textarea name="tipo_discap" rows="4"
                                class="form-textarea w-full rounded-lg border-gray-300 shadow-sm p-4 focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50 transition duration-200 bg-white text-gray-700 resize-none" placeholder="Describa la condición aquí...">{{ old('tipo_discap') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- BOTÓN GUARDAR FINAL --}}
                <div class="pt-8 border-t border-gray-200">
                    <button type="submit"
                        class="w-full sm:w-auto float-right inline-flex justify-center items-center px-8 py-4 border border-transparent text-lg font-bold rounded-xl shadow-md text-white bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-700 hover:to-orange-600 focus:outline-none focus:ring-4 focus:ring-orange-300 transform hover:-translate-y-1 transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        Registrar Estudiante
                    </button>
                     <div class="clear-both"></div> {{-- Limpiar el float --}}
                </div>

            </form>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    // --- Lógica de Discapacidad (Animación mejorada) ---
    const checkbox = document.getElementById('discapacidad_check');
    const section = document.getElementById('tipo_discapacidad_section');

    function toggleSection(isChecked) {
        if (isChecked) {
             // Mostrar
            section.style.maxHeight = section.scrollHeight + "px"; // Altura dinámica
            section.style.opacity = "1";
            section.style.marginTop = "1.5rem"; // mt-6 equivalente
        } else {
            // Ocultar
            section.style.maxHeight = "0px";
            section.style.opacity = "0";
            section.style.marginTop = "0px";
        }
    }

    // Estado inicial (si hubo error de validación)
    if(checkbox.checked) {
        section.style.maxHeight = "auto"; // O un valor alto seguro si auto falla en carga inicial
        setTimeout(() => { toggleSection(true); }, 100); // Pequeño delay para asegurar transición
    }

    checkbox.addEventListener('change', function() {
        toggleSection(this.checked);
    });

    // --- Lógica de FOTO + PREVIEW (Modernizado) ---
    const input = document.getElementById('foto');
    const fileNameTxt = document.getElementById('file-name');
    const fileError = document.getElementById('file-error');
    const previewImage = document.getElementById('preview-image');
    const previewContainer = document.getElementById('preview-container');
    const dropzoneContainer = document.getElementById('dropzone-container');


    // Hacer que todo el contenedor active el input file al hacer clic
    dropzoneContainer.addEventListener('click', () => input.click());

    // Prevenir comportamiento por defecto de arrastrar y soltar
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropzoneContainer.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults (e) {
        e.preventDefault();
        e.stopPropagation();
    }

    // Efectos visuales al arrastrar
    ['dragenter', 'dragover'].forEach(eventName => {
        dropzoneContainer.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropzoneContainer.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        dropzoneContainer.classList.add('border-orange-500', 'bg-orange-100');
    }

    function unhighlight(e) {
        dropzoneContainer.classList.remove('border-orange-500', 'bg-orange-100');
    }

    // Manejar el archivo soltado
    dropzoneContainer.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        let dt = e.dataTransfer;
        let files = dt.files;
        input.files = files; // Asignar los archivos al input
        handleFiles(files); // Procesar
    }

    input.addEventListener('change', function() {
        handleFiles(this.files);
    });


    function handleFiles(files) {
        const file = files[0];

        if (!file) {
            resetPreview();
            fileNameTxt.textContent = 'Ningún archivo seleccionado aún';
            return;
        }

        const allowedExtensions = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];

        if (!allowedExtensions.includes(file.type)) {
            fileNameTxt.textContent = file.name;
            fileError.textContent = '❌ Formato no válido. Solo JPG, PNG o WEBP.';
            fileError.classList.remove('hidden');
            resetPreview();
            input.value = ""; // Limpiar input
            return;
        }

        // Archivo válido
        fileNameTxt.textContent = `Archivo seleccionado: ${file.name}`;
        fileNameTxt.classList.add('text-orange-600', 'font-medium');
        fileError.classList.add('hidden');

        const reader = new FileReader();
        reader.onload = e => {
            previewImage.src = e.target.result;
            previewContainer.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }

    function resetPreview() {
        previewContainer.classList.add('hidden');
        previewImage.src = "";
        fileNameTxt.classList.remove('text-orange-600', 'font-medium');
    }
});
</script>
@endpush