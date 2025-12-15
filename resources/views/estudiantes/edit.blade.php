@extends('layouts.app')

@section('title', 'Editar Estudiante')

@section('content')
<div class="max-w-5xl mx-auto p-6">

    <div class="bg-white shadow-xl rounded-2xl p-8 space-y-8">

        {{-- TÍTULO --}}
        <h2 class="text-2xl text-center font-bold text-orange-600">
            ✏️ Editar Estudiante
        </h2>

        <form method="POST"
            action="{{ route('estudiantes.update', $estudiante->Id_estudiante) }}"
            enctype="multipart/form-data"
            class="space-y-8">

            @csrf
            @method('PUT')

            {{-- ================= DATOS PERSONALES ================= --}}
            <div>
                <div class="flex items-center space-x-2 mb-6 pb-2 border-b border-orange-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <h2 class="text-xl font-bold text-gray-800">
                        Datos Personales
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- NOMBRES --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nombres</label>
                        <input type="text" name="nombres"
                            value="{{ old('nombres', $estudiante->nombres) }}"
                            required
                            class="w-full h-11 px-4 rounded-lg border border-gray-300
                                      focus:border-orange-500 focus:ring focus:ring-orange-200">
                    </div>

                    {{-- APELLIDOS --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Apellidos</label>
                        <input type="text" name="apellidos"
                            value="{{ old('apellidos', $estudiante->apellidos) }}"
                            required
                            class="w-full h-11 px-4 rounded-lg border border-gray-300
                                      focus:border-orange-500 focus:ring focus:ring-orange-200">
                    </div>

                    {{-- TELÉFONO --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Teléfono</label>
                        <input type="text" name="telefono"
                            value="{{ old('telefono', $estudiante->telefono) }}"
                            class="w-full h-11 px-4 rounded-lg border border-gray-300
                                      focus:border-orange-500 focus:ring focus:ring-orange-200">
                    </div>

                    {{-- EDAD --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Edad</label>
                        <input type="number" name="edad"
                            value="{{ old('edad', $estudiante->edad) }}"
                            class="w-full h-11 px-4 rounded-lg border border-gray-300
                                      focus:border-orange-500 focus:ring focus:ring-orange-200">
                    </div>

                    {{-- DIRECCIÓN --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Dirección</label>
                        <textarea name="direccion" rows="3"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300
                                         focus:border-orange-500 focus:ring focus:ring-orange-200 resize-none">{{ old('direccion', $estudiante->direccion) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- ================= DATOS ACADÉMICOS ================= --}}
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

                    {{-- GRADO --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Grado</label>
                        <select name="grado" required
                            class="w-full h-11 px-4 rounded-lg border border-gray-300
                                       focus:border-orange-500 focus:ring focus:ring-orange-200">
                            @foreach(['Primero','Segundo','Tercero','Cuarto','Quinto','Sexto'] as $g)
                            <option value="{{ $g }}" {{ old('grado', $estudiante->grado) === $g ? 'selected' : '' }}>
                                {{ $g }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- SECCIÓN --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Sección</label>
                        <select name="seccion" required
                            class="w-full h-11 px-4 rounded-lg border border-gray-300
                                       focus:border-orange-500 focus:ring focus:ring-orange-200">
                            @foreach(['A','B','C','D','E','F'] as $s)
                            <option value="{{ $s }}" {{ old('seccion', $estudiante->seccion) === $s ? 'selected' : '' }}>
                                {{ $s }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- ESTADO --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Estado</label>
                        <select name="estado" required
                            class="w-full h-11 px-4 rounded-lg border border-gray-300
                                       focus:border-orange-500 focus:ring focus:ring-orange-200">
                            <option value="Activo" {{ old('estado', $estudiante->estado) === 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Retirado" {{ old('estado', $estudiante->estado) === 'Retirado' ? 'selected' : '' }}>Retirado</option>
                        </select>
                    </div>
                </div>
            </div>
            {{-- ================= INFORMACIÓN MÉDICA ================= --}}
            <div>
                <div class="flex items-center space-x-2 mb-6 pb-2 border-b border-orange-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h2 class="text-xl font-bold text-gray-800">
                            Información Médica / Adicional
                        </h2>
                    </div>

                {{-- CHECK DISCAPACIDAD --}}
                <div class="bg-orange-50 p-5 rounded-xl border border-orange-200">
                    <label class="flex items-start gap-4 cursor-pointer">
                        <input type="checkbox"
                            name="discapacidad"
                            id="discapacidad_check"
                            value="1"
                            {{ old('discapacidad', $estudiante->discapacidad) ? 'checked' : '' }}
                            class="h-6 w-6 mt-1 text-orange-600 border-gray-300 rounded
                          focus:ring-orange-500 transition">

                        <div>
                            <p class="text-gray-800 font-semibold">
                                ¿Presenta alguna discapacidad o condición médica?
                            </p>
                            <p class="text-sm text-gray-500">
                                Marque si el estudiante requiere atención especial.
                            </p>
                        </div>
                    </label>
                </div>

                {{-- DETALLE DISCAPACIDAD --}}
                <div id="detalle_discapacidad"
                    class="{{ old('discapacidad', $estudiante->discapacidad) ? 'mt-6 opacity-100' : 'mt-0 opacity-0 hidden' }}
                transition-all duration-300">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Detalle de la condición médica
                    </label>

                    <textarea name="tipo_discap"
                        rows="4"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300
                         focus:border-orange-500 focus:ring focus:ring-orange-200 resize-none"
                        placeholder="Describa la condición médica...">{{ old('tipo_discap', $estudiante->tipo_discap) }}</textarea>
                </div>
            </div>
            {{-- ================= FOTO ================= --}}
            <div>
                <div class="flex items-center space-x-2 mb-6 pb-2 border-b border-orange-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <h2 class="text-xl font-bold text-gray-800">
                            Fotografía del Estudiante
                        </h2>
                    </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">

                    {{-- FOTO ACTUAL --}}
                    <div class="text-center">
                        <p class="text-sm font-semibold text-gray-600 mb-2">Foto actual</p>
                        @if($estudiante->foto)
                        <img src="{{ asset('storage/'.$estudiante->foto) }}"
                            class="mx-auto w-32 h-32 object-cover rounded-full shadow">
                        @else
                        <p class="text-gray-400 text-sm">Sin foto</p>
                        @endif
                    </div>

                    {{-- FOTO NUEVA + PREVIEW --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Nueva foto
                        </label>

                        <input type="file" name="foto" id="fotoInput"
                            class="block w-full text-sm text-gray-600
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-lg file:border-0
                                      file:bg-orange-50 file:text-orange-700
                                      hover:file:bg-orange-100">

                        <div id="previewContainer" class="hidden mt-4 text-center">
                            <p class="text-sm font-semibold text-gray-600 mb-2">Vista previa</p>
                            <img id="previewImage"
                                class="mx-auto w-32 h-32 object-cover rounded-full shadow border">
                        </div>
                    </div>
                </div>
            </div>

            {{-- ================= BOTONES ================= --}}
            <div class="flex justify-between pt-6 border-t">

                <a href="{{ route('estudiantes.show', $estudiante->Id_estudiante) }}"
                    class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition">
                    Volver
                </a>

                <button type="submit"
                    class="bg-orange-600 text-white px-6 py-2 rounded-lg hover:bg-orange-700 transition">
                    Guardar Cambios
                </button>
            </div>

        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('fotoInput')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        const previewContainer = document.getElementById('previewContainer');
        const previewImage = document.getElementById('previewImage');

        if (!file) {
            previewContainer.classList.add('hidden');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(event) {
            previewImage.src = event.target.result;
            previewContainer.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    });
</script>
@endpush