<div>
    <!-- Flash message SUCCESS -->
    <div class="relative flex items-center justify-center">
        @if (session('success'))
        <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show = false,3000)"
            class="absolute flex top-0 left-1/2 transform -translate-x-1/2 mt-4 bg-green-100 text-green-700 p-4 rounded shadow-md z-50">
            <!-- Icono-->
            <svg class="w-6 h-6 mr-3 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <p>{{ session('success') }}</p>
        </div>
        @endif
    </div>

    <!-- Flash message ERROR-->
    <div class="relative flex items-center justify-center">
        @if (session('error'))
        <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show = false,3000)"
            class="absolute flex top-0 left-1/2 transform -translate-x-1/2 mt-4 bg-red-100 text-red-700 p-4 rounded shadow-md z-50">
            <!-- Icono-->
            <svg class="w-6 h-6 mr-3 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            <p>{{ session('error') }}</p>
        </div>
        @endif
    </div>

    <!-- Flash message EXISTS -->
    <div class="relative flex items-center justify-center">
        @if (session('exists'))
        <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show = false,5000)"
            class="absolute flex top-0 left-1/2 transform -translate-x-1/2 mt-4 p-4 rounded shadow-md z-50 alerta-amarilla">
            <!-- Icono-->
            <svg class="w-6 h-6 mr-3 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01M10.29 3.86l-7.15 12.42A2 2 0 005 20h14a2 2 0 001.71-3.12L13.71 3.86a2 2 0 00-3.42 0z" />
            </svg>
            </svg>
            <p>{{ session('exists') }}</p>
        </div>
        @endif
    </div>
</div>