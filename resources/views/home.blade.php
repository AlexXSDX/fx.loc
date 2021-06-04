<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MyFX</title>

        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        <script src="{{ asset('js/script.js') }}"></script>

    </head>

    <body>
    	<button id="updateCurrenciesButton">
    		Обновить курсы валют
    	</button>
    	<br>
    	<img class="loading hidden" src="{{asset('images/loading.gif')}}" alt="loading" />

    	<div id="responce"></div>
    </body>

</html>