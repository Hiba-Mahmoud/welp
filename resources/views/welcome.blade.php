<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>{{ env('APP_NAME') }}</title>
</head>
<body>
    <div class="p-2 fw-bold" style="letter-spacing: 1px;">

        <div>
            welcome to: <span style="text-decoration: underline">{{ env('APP_NAME') }}</span>
        </div>

        <div class="my-2">
            @if (env('SERVER'))
                server running . . .
            @else
                <div style="color: red">
                    server not running
                </div>
            @endif
        </div>

    </div>

</body>
</html>
