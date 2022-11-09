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

<header>
    <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
            <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2" style="padding-left: 800px; padding-top: 10px">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li>
                        <a href="/admin" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Home</a>
                    </li>
                    <li>
                        <a href="/allSchools" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Všetky školy</a>
                    </li>
                    <li>
                        <a href="/manageSchools" class="block py-2 pr-4 pl-3 text-blue-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Správa škôl</a>
                    </li>
                </ul>
            </div>
    </nav>
</header>

<div style="padding-left: 50px">
    <p class="text-3xl">Add new School</p>

    <form method="post" action="/api/schools" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group row pt-2">
            <label for="nameid" class="col-sm-3 col-form-label">School name:</label>
            <div class="col-sm-9">
                <input name="name" type="text" class="form-control" id="nameid" placeholder="School name">
            </div>
        </div>
        <div class="form-group row pt-2">
            <label for="addressid" class="col-sm-3 col-form-label">Address:</label>
            <div class="col-sm-9">
                <input name="address" type="text" class="form-control" id="addressid" placeholder="Address">
            </div>
        </div>
        <div class="form-group row pt-2">
            <label for="typeid" class="col-sm-3 col-form-label">Type:</label>
            <div class="col-sm-9">
                <input name="type" type="text" class="form-control" id="typeid" placeholder="School type">
            </div>
        </div>
        <div class="form-group row pt-2">
            <label for="imageid" class="col-sm-3 col-form-label">Image:</label>
            <div class="col-sm-9">
                <input name="image" type="file" id="imageid" class="custom-file-input">
                <span style="margin-left: 15px; width: 480px;" class="custom-file-control"></span>
            </div>
        </div>
        <div class="offset-sm-3 col-sm-9 pt-2">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
                    Submit
                </button>
        </div>
    </form>
</div>
</html>
