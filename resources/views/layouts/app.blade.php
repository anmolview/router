<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>
            Router
        </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>


    </head>
    <body>

        <div class="container">
        @yield('content')
        </div>
        <script type="text/javascript">
        function formatMAC(e) {
            var r = /([a-f0-9]{2})([a-f0-9]{2})/i,
                str = e.target.value.replace(/[^a-f0-9]/ig, "");
            
            while (r.test(str)) {
                str = str.replace(r, '$1' + ':' + '$2');
            }

            e.target.value = str.slice(0, 17);
        };

        $('#mac_address').keydown(formatMAC);
        </script>
        @yield('scripts')  

    </body>
</html>
