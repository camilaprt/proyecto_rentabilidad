<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Accounix</title>
  <!-- Fonts -->
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
    rel="stylesheet" />
  <!-- Local Tailwind -->
  <link rel="stylesheet" href="{{asset('css/tailwind.output.css')}}" />
  <!-- Local CSS -->
  <link rel="stylesheet" href="{{asset('css/custom.css')}}" />


  @livewireStyles
</head>


<body>
  <div class="flex h-screen bg-gray-50">
    <!-- Desktop sidebar -->
    <aside class="z-20 hidden w-64 overflow-y-auto bg-white md:block flex-shrink-0">
      <div class="py-4 text-gray-500">
        <a class="ml-6 text-lg font-bold text-gray-800" href="#">Proyecto Rentabilidad</a>
        {{-- NAV PRINCIPAL --}}
        <ul class="mt-6">
          <li class="relative px-6 py-3">
            @if(request()->routeIs('home'))
            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
            @endif
            <a href="{{ route('home') }}" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800">
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
              </svg>
              <span class="ml-4">Dashboard</span>
            </a>
          </li>
          <li class="relative px-6 py-3">
            @if(request()->routeIs('proyectos'))
            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
            @endif
            <a href="{{ route('proyectos') }}" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 ">
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
              </svg>
              <span class="ml-4">Proyectos</span>
            </a>
          </li>
          <li class="relative px-6 py-3">
            @if(request()->routeIs('ventas'))
            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
            @endif
            <a href="{{ route('ventas') }}" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800">
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M4 6h16v12H4z M4 6a2 2 0 0 1 2 2 M20 6a2 2 0 0 0-2 2 M4 18a2 2 0 0 0 2-2 M20 18a2 2 0 0 1-2-2 M12 12a2 2 0 1 0 0-0.01" />
              </svg>
              <span class="ml-4">Ventas</span>
            </a>
          </li>
          <li class="relative px-6 py-3">
            @if(request()->routeIs('compras'))
            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
            @endif
            <a href="{{ route('compras') }}" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 ">
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M9 14h6M9 10h6M5 4h14v16l-2-2-2 2-2-2-2 2-2-2-2 2z" />
              </svg>
              <span class="ml-4">Compras</span>
            </a>
          </li>

          <li class="relative px-6 py-3">
            @if(request()->routeIs('clientes'))
            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
            @endif
            <a href="{{ route('clientes') }}" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 ">
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M17 21H7a2 2 0 0 1-2-2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1a2 2 0 0 1-2 2zM12 11a4 4 0 1 0-4-4 4 4 0 0 0 4 4z" />
              </svg>
              <span class="ml-4">Clientes</span>
            </a>
          </li>

          <li class="relative px-6 py-3">
            @if(request()->routeIs('proveedores'))
            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
            @endif
            <a href="{{ route('proveedores') }}" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800">
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M20 7h-3V6a2 2 0 00-2-2h-6a2 2 0 00-2 2v1H4a2 2 0 00-2 2v9a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2zM9 6h6v1H9V6z" />
              </svg>
              <span class="ml-4">Proveedores</span>
            </a>
          </li>
          <li class="relative px-6 py-3">
            @if(request()->routeIs('categorias'))
            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
            @endif
            <a href="{{ route('categorias') }}" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800">
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
              </svg>
              <span class="ml-4">Categorias</span>
            </a>
          </li>
          <li class="relative px-6 py-3">
            @if(request()->routeIs('show.login'))
            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
            @endif
            <a href="{{ route('show.login') }}" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800">
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
              </svg>
              <span class="ml-4">Log in</span>
            </a>
          </li>
        </ul>

    </aside>

    <!-- Contenido principal -->
    <div class="flex-1 flex flex-col overflow-hidden">
      <!-- Aquí va el contenido de la página -->
      <main class="h-full pb-16 overflow-y-auto">
        <!-- Remove everything INSIDE this div to a really blank page -->
        <div class="container px-6 mx-auto grid">
          <!-- Insert from this point to keep layout in place -->
          <!-- Mensaje flash -->
          <livewire:flash-message></livewire:flash-message>
          <div class="my-6 text-2xl font-semibold text-gray-700">
            {{ $slot }}

          </div>

        </div>
      </main>
    </div>
  </div>
  @livewireScripts
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</body>

</html>