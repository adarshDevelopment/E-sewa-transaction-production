<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->

    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50 min-h-screen min-w-screen">

    <div class="container mx-auto h-50  p-20 flex justify-center">
        {{-- <button
            class=" border border-neutral-400 px-3 py-1 rounded-md font-semibold hover:bg-neutral-400 hover:text-white">
            Pay with Esewa
        </button> --}}

        <form action="{{ route('esewa') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="10">
            <input type="hidden" name="name" value="John Cena">
            <input type="hidden" name="email" value="john@cena.com">
            <input type="hidden" name="amount" value="99">

            <button
                class=" border border-neutral-400 px-3 py-1 rounded-md font-semibold hover:bg-neutral-400 hover:text-white">
                Pay with Esewa
            </button>



        </form>

    </div>
</body>

</html>
