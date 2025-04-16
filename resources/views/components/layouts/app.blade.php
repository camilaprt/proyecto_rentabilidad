<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Blank - Windmill Dashboard</title>
  <!-- Fonts -->
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
    rel="stylesheet" />
  <!-- Local Tailwind -->
  <link rel="stylesheet" href="{{asset('css/tailwind.output.css')}}" />

  @livewireStyles
</head>


<body>
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Desktop sidebar -->
    <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
      <div class="py-4 text-gray-500 dark:text-gray-400">
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">Windmill</a>
        {{-- NAV PRINCIPAL --}}
        <ul class="mt-6">
          <li class="relative px-6 py-3">
            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
            <a href="{{ route('home') }}" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
              </svg>
              <span class="ml-4">Dashboard</span>
            </a>
          </li>
          <li class="relative px-6 py-3">
            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
            <a href="{{ route('ventas') }}" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M4 6h16v12H4z M4 6a2 2 0 0 1 2 2 M20 6a2 2 0 0 0-2 2 M4 18a2 2 0 0 0 2-2 M20 18a2 2 0 0 1-2-2 M12 12a2 2 0 1 0 0-0.01" />
              </svg>
              <span class="ml-4">Ventas</span>
            </a>
          </li>
          <li class="relative px-6 py-3">
            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
            <a href="{{ route('compras') }}" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M9 14h6M9 10h6M5 4h14v16l-2-2-2 2-2-2-2 2-2-2-2 2z" />
              </svg>
              <span class="ml-4">Compras</span>
            </a>
          </li>

          <li class="relative px-6 py-3">
            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
            <a href="{{ route('clientes') }}" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M17 21H7a2 2 0 0 1-2-2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1a2 2 0 0 1-2 2zM12 11a4 4 0 1 0-4-4 4 4 0 0 0 4 4z" />
              </svg>
              <span class="ml-4">Clientes</span>
            </a>
          </li>

          <li class="relative px-6 py-3">
            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
            <a href="{{ route('proveedores') }}" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M20 7h-3V6a2 2 0 00-2-2h-6a2 2 0 00-2 2v1H4a2 2 0 00-2 2v9a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2zM9 6h6v1H9V6z" />
              </svg>
              <span class="ml-4">Proveedores</span>
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
          <div class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{ $slot }}

          </div>

        </div>
      </main>
    </div>
  </div>
  @livewireScripts

</body>

</html>