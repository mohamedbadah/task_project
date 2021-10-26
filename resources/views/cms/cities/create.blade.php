@extends('cms.parent')
@section('title','title')
@section('styles')

@endsection
@section('page-title','page title')
@section('main-page-title','main page title')
@section('small-page-title','small page title')
@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
    <div class="col-md-12">
 <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{route('cities.store')}}">
                @csrf
                <div class="card-body">
                    @if ($errors->any())
                 <div class="alert alert-danger alert-dismissible">

                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                       @foreach ($errors->all() as $error)
                         <li>{{$error}}</li>
                       @endforeach
                </div>
              @endif
              @if (session()->has('message'))
                 <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    {{session('message')}}
                </div>
              @endif
                  <div class="form-group">
                    <label for="exampleInputEmail1">city name</label>
                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="enter city name">
                  </div>
                   <div class="form-group">
                  <input type="submit" class="btn btn-primary" class="form-control">
                </div>
                </div>
              </form>
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
@endsection
@section('sctipts')

@endsection
