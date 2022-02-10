@extends('cms.parent')
@section('title','title')
@section('styles')

@endsection
@section('page-title','create User')
@section('main-page-title','users')
@section('small-page-title','user')
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
                  <div class="form-group">
                    <label for="name">name</label>
                    <input type="text" class="form-control" id="name" placeholder="enter city name">
                  </div>
                  <div class="form-group">
                    <label for="name">email</label>
                    <input type="email" class="form-control" id="email" placeholder="enter city name">
                  </div>
                  <div class="form-group">
                    <label for="name">password</label>
                    <input type="password" class="form-control" id="password" placeholder="enter city name">
                  </div>
                  <div class="form-group">
                    <label for="name"> confirm password</label>
                    <input type="password" class="form-control" id="Cpassword" placeholder="enter city name">
                  </div>
                   <div class="form-group">
                  <button type="button" class="btn btn-primary" class="form-control" onclick="store()">Store</button>
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
                axios.post('/cms/index-create',{
                    name:document.getElementById('name').value,
                    email:document.getElementById('email').value,
                    password:document.getElementById('password').value,
                    Cpassword:document.getElementById('Cpassword').value
                }
     ).then(function (response) {
            toastr.success(response.data.message)
             window.location.href="/cms/index-user"
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
