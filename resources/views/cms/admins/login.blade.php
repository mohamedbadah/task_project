<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.css')}}">
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-4 offset-4" style="margin-top:15px">
<h1>Login Admin</h1>
<hr>
<form action="{{route('admin.check')}}" method="POST" autocomplete="off">
    @csrf
    @if (Session('fail'))
    <div class='alert alert-danger'>{{Session('fail')}}</div>
    @endif
    <div class='form-group'>
    <label for="eamil">email</label>
    <input type="email" class="form-control" name="email" placeholder="enter the user name" value="{{old('email')}}">
    <span style="color:red">@error('email')
        {{$message}}
    @enderror</span>
    </div>
      <div class='form-group'>
    <label for="eamil">password</label>
    <input type="password" class="form-control" name="password" placeholder="enter the user name" value="{{old('password')}}">
      <span style="color:red">@error('password')
        {{$message}}
    @enderror</span>
      </div>
      <div class='form-group'>
        <button type="submit" class="btn btn-success"> log in</button>
      </div>
</form>
</div>
</div>
</body>
</html>
