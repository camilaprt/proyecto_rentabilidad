<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Accounix</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- Local Tailwind -->
    <link rel="stylesheet" href="{{asset('css/tailwind.output.css')}}" />
</head>

<body>
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
        <div
            class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl">
            <div class="flex flex-col overflow-y-auto md:flex-row">
                <div class="h-32 md:h-auto md:w-1/2">
                    <img
                        aria-hidden="true"
                        class="object-cover w-full h-full dark:hidden"
                        src="{{asset('img/login-office.jpeg')}}"
                        alt="Office" />

                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">

                    <div class="w-full">
                        <h1
                            class="mb-4 text-xl font-semibold text-gray-700 ">
                            Login
                        </h1>
                        <!-- Log in form -->
                        <form action="{{route('login')}}" method="POST">
                            @csrf
                            <label for="email" class="block text-sm">
                                <span class="text-gray-700 ">Email</span>
                                <input
                                    type="email"
                                    name="email"
                                    required
                                    value="{{ old('email')}}"
                                    class="block w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                                    placeholder="Jane Doe" />
                            </label>
                            <label for="password" class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Contraseña</span>
                                <input
                                    type="password"
                                    name="password"
                                    required
                                    class="block w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                                    placeholder="***************" />
                            </label>

                            <button
                                type="submit"
                                class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                Log in
                            </button>
                        </form>
                        @error('credentials')
                        <div class="text-red-700 text-sm mt-1">{{ $message }}</div>
                        @enderror

                        <hr class="my-8" />
                        <!-- Create account  -->
                        <p class="mt-1">
                            <a
                                class="text-sm font-medium text-purple-600 hover:underline"
                                href="{{route('show.register')}}">
                                Crear cuenta
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>