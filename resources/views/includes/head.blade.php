<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">

    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">

    <!-- Favicons -->
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="icon" sizes="16x16 32x32 48x48 64x64" href="/favicons/favicon.ico">
    <link rel="icon" type="image/png" sizes="196x196" href="/favicons/favicon-192.png">
    <link rel="icon" type="image/png" sizes="160x160" href="/favicons/favicon-160.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicons/favicon-96.png">
    <link rel="icon" type="image/png" sizes="64x64" href="/favicons/favicon-64.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16.png">
    <link rel="apple-touch-icon" href="/favicons/favicon-57.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/favicons/favicon-114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/favicons/favicon-72.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/favicons/favicon-144.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/favicons/favicon-60.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/favicons/favicon-120.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/favicons/favicon-76.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/favicons/favicon-152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicons/favicon-180.png">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="msapplication-TileImage" content="/favicons/favicon-144.png">
    <meta name="msapplication-config" content="/favicons/browserconfig.xml">
    <!-- Favicons -->

    <!-- Scripts -->
    <script>
        window.Laravel = @php json_encode(['csrfToken' => csrf_token()]); @endphp
    </script>
    <style>
        body {
            padding-top: 20px;
            padding-bottom: 20px;
        }
    </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
