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
        <ul class="mt-6">
          <li class="relative px-6 py-3">
            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
            <a
              class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
              href="../index.html">
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path
                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
              </svg>
              <span class="ml-4">Dashboard</span>
            </a>
          </li>
        </ul>
        <ul>
          <li class="relative px-6 py-3">
            <a
              class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
              href="../forms.html">
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path
                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
              </svg>
              <span class="ml-4">Forms</span>
            </a>
          </li>
          <!-- Otros elementos de menú -->
        </ul>
      </div>
    </aside>

    <!-- Contenido principal -->
    <div class="flex-1 flex flex-col overflow-hidden">
      <!-- Aquí va el contenido de la página -->
      <main class="h-full pb-16 overflow-y-auto">
        <!-- Remove everything INSIDE this div to a really blank page -->
        <div class="container px-6 mx-auto grid">
          <!-- Insert from this point to keep layout in place -->
          <!-- Flash message -->
          <div class="flex flex items-center justify-center">
            @if (session('success'))
            <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show = false,2000)" class="alert alert-success bg-green-100 text-green-700 p-4 rounded shadow-md">
              <p>{{ session('success') }}</p>
            </div>
            @endif
          </div>
          <!-- END Flash message -->
          <!-- Flash message -->
          <div class="flex flex items-center justify-center">
            @if (session('error'))
            <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show = false,2000)" class="alert alert-success bg-red-100 text-red-700 p-4 rounded shadow-md">
              <p>{{ session('error') }}</p>
            </div>
            @endif
          </div>
          <!-- END Flash message -->
          <h2
            class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{ $slot }}

          </h2>
        </div>
      </main>
    </div>
  </div>
  @livewireScripts

</body>

</html>