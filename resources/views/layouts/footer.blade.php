<footer class="bg-gray-900 text-gray-300 mt-20 border-t-4 border-orange-500 relative" id="footer">
    
    {{-- Efecto de fondo sutil (opcional para darle profundidad) --}}
    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-full h-1 bg-gradient-to-r from-transparent via-orange-500 to-transparent opacity-50"></div>

    <div class="max-w-7xl mx-auto px-6 pt-16 pb-8">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">

            {{-- COLUMNA 1: Identidad Institucional --}}
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-orange-500/10 rounded-lg">
                         {{-- Icono Libro/Colegio --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-lg tracking-wide uppercase">I.E.P. 2028</h3>
                        <span class="text-orange-500 text-sm font-semibold tracking-widest">PERUANO BRITÁNICO</span>
                    </div>
                </div>
                
                <p class="text-gray-400 text-sm leading-relaxed border-l-2 border-gray-700 pl-4">
                    Institución Educativa Bicentenario líder en San Martín de Porres. Formamos el futuro con tecnología, valores y excelencia en el idioma inglés.
                </p>
            </div>

            {{-- COLUMNA 2: Sobre el Sistema --}}
            <div>
                <h3 class="text-white font-bold uppercase tracking-wider mb-6 border-b border-gray-800 pb-2 inline-block">
                    Gestión Académica
                </h3>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3 group">
                        <svg class="w-5 h-5 text-orange-500 mt-0.5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="group-hover:text-white transition-colors text-sm">Registro de nuevos estudiantes</span>
                    </li>
                    <li class="flex items-start gap-3 group">
                        <svg class="w-5 h-5 text-orange-500 mt-0.5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="group-hover:text-white transition-colors text-sm">Control de asistencia en tiempo real</span>
                    </li>
                    <li class="flex items-start gap-3 group">
                        <svg class="w-5 h-5 text-orange-500 mt-0.5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="group-hover:text-white transition-colors text-sm">Generación de reportes PDF</span>
                    </li>
                </ul>
            </div>

            {{-- COLUMNA 3: Contacto --}}
            <div>
                <h3 class="text-white font-bold uppercase tracking-wider mb-6 border-b border-gray-800 pb-2 inline-block">
                    Contáctanos
                </h3>
                <div class="space-y-4">
                    
                    {{-- Dirección --}}
                    <div class="flex items-start gap-3">
                        <div class="bg-gray-800 p-2 rounded-full shrink-0">
                            <svg class="w-5 h-5 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-white text-sm font-medium">Sede Principal</p>
                            <p class="text-sm text-gray-500">San Martín de Porres, Lima – Perú</p>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="flex items-start gap-3">
                        <div class="bg-gray-800 p-2 rounded-full shrink-0">
                            <svg class="w-5 h-5 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-white text-sm font-medium">Correo Electrónico</p>
                            <a href="mailto:soporte@iep2028.edu.pe" class="text-sm text-gray-500 hover:text-orange-400 transition-colors">soporte@iep2028.edu.pe</a>
                        </div>
                    </div>

                    {{-- Teléfono --}}
                    <div class="flex items-start gap-3">
                        <div class="bg-gray-800 p-2 rounded-full shrink-0">
                            <svg class="w-5 h-5 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-white text-sm font-medium">Secretaría</p>
                            <p class="text-sm text-gray-500 hover:text-orange-400 transition-colors cursor-pointer">+51 929 419 779</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- Barra inferior / Copyright --}}
        <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-xs text-gray-500 text-center md:text-left">
                © {{ date('Y') }} <span class="text-white font-medium">I.E.P. 2028 Peruano Británico</span>. Todos los derechos reservados.
            </p>
            
            {{-- Redes Sociales (Decorativas) --}}
            <div class="flex space-x-4">
                <a href="#" class="text-gray-500 hover:text-orange-500 transition-colors">
                    <span class="sr-only">Facebook</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                </a>
                <a href="#" class="text-gray-500 hover:text-orange-500 transition-colors">
                    <span class="sr-only">Instagram</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.468 2.53c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg>
                </a>
            </div>
        </div>

    </div>
</footer>