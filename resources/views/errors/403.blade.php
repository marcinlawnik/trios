<!DOCTYPE html>
<html>
    <head>
        <title>Access denied</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:300,700" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #444;
                display: table;
                font-weight: 300;
                font-family: 'Lato', sans-serif;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .code {
                font-size: 10em;
                color: #A62639;
                line-height: .8em;
            }

            .title {
                font-size: 3em;
                color: #666;
                margin-bottom: .4em;
                font-weight: 700;
            }

            .explanation {
                font-size: 1.3em;
                line-height: 1.5em;
                margin-bottom: 1em;
            }

            a {
                color: #256EFF;
                text-decoration: none;
            }
            a:hover {
                color: #003aad;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="code">403</div>
                <div class="title">Access denied!</div>
                <div class="explanation">
                    You are not allowed to displayed the requested page.<br>
                    Please make sure that you're logged in and have sufficient permissions.<br>
                </div>
                <a href="{{ action('HomeController@index') }}">Go back to the home page</a>
            </div>
        </div>
    </body>
</html>
