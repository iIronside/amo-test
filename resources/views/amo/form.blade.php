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

    <div class="card">
        <div class="card-header text-center font-weight-bold">
            <h2>Send request to Amo</h2>
        </div>
        <div class="card-body">
            <form name="add-blog-post-form" id="form" method="post" action="{{url('amo/send-form')}}">
                @csrf

                <div class="form-group">
                    <label for="inputName">Name</label>
                    <input type="text" id="name" name="name" class="@error('name') is-invalid @enderror form-control">
                    @error('name')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="inputEmail">Email</label>
                    <input type="email" id="email" name="email" class="@error('email') is-invalid @enderror form-control">
                    @error('email')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="inputPhone">Phone</label>
                    <input type="tel" id="phone" name="phone" class="@error('phone') is-invalid @enderror form-control">
                    @error('phone')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="inputPrice">Price</label>
                    <input type="number" id="price" name="price" class="@error('price') is-invalid @enderror form-control">
                    @error('price')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
