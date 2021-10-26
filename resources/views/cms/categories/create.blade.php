@extends('cms.parent')
@section('title','title')
@section('styles')

@endsection
@section('page-title','create categry')
@section('main-page-title','categories')
@section('small-page-title','category')
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
              <form>
                @csrf
                <div class="card-body">
                    {{-- @if ($errors->any())
                 <div class="alert alert-danger alert-dismissible">

                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                       @foreach ($errors->all() as $error)
                         <li>{{$error}}</li>
                       @endforeach
                </div>
              @endif --}}
              {{-- @if (session()->has('message'))
                 <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    {{session('message')}}
                </div>
              @endif --}}
                  <div class="form-group">
                    <label for="name">city name</label>
                    <input type="text" class="form-control" id="name" placeholder="enter city name">
                  </div>
                   <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="active">
                      <label class="custom-control-label" for="active">active</label>
                    </div>
                  </div>
                   <div class="form-group">
                  <button class="btn btn-primary" class="form-control" onclick="store()">Store</button>
                </div>
                </div>
              </form>
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
@endsection
@section('scripts')
<script>
            function store(){
                axios.post('/cms/admin/categories',{
                    name:document.getElementById('name').value,
                    active:document.getElementById('active').checked

                })
        .then(function (response) {
            toastr.success(response.data.message)
             window.location.href="/cms/admin/categories"
            console.log(response);
        })
        .catch(function (error) {
            toastr.error(error.response.data.message)
            console.log(error);
        })
        .then(function () {
            // always executed
        });
            }
</script>
@endsection
