<!DOCTYPE html>
<html>
<head>
    <title>Send request to Amo</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>

<div class="container mt-4">

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Данные сохранены!</h4>
            <p>{{ $message }}.</p>
        </div>
</div>
</body>
</html>
