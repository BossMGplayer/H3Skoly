<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">


</head>

<body>
<div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px" style="justify-content: center">
        <li class="mr-2">
            <a href="{{'/allSchools'}}" class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-blue-500 hover:border-blue-500 dark:hover:text-blue-500">Školy</a>
        </li>
        <li class="mr-2">
            <a href="#" class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-blue-500 hover:border-blue-500 dark:hover:text-blue-500">Odbory</a>
        </li>
        <li class="mr-2">
            <a href="#" class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-blue-500 hover:border-blue-500 dark:hover:text-blue-500">Predmety</a>
        </li>
        <li class="mr-2">
            <a href="#" class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-blue-500 hover:border-blue-500 dark:hover:text-blue-500">Obedy</a>
        </li>
        <li class="mr-2">
            <a href="#" class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-blue-500 hover:border-blue-500 dark:hover:text-blue-500">Hodnotenia obedov</a>
        </li>
        <li class="mr-2">
            <a href="#" class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-blue-500 hover:border-blue-500 dark:hover:text-blue-500">Hodnotenia predmetov</a>
        </li>
    </ul>
</div>
</body>

</html>
