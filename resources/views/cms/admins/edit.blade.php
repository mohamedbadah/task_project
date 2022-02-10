@extends('cms.parent')
@section('title','title')
@section('styles')

@endsection
@section('page-title','edit category')
@section('main-page-title','main category')
@section('small-page-title','small page category')
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
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" value="{{$admin->name}}" id="name" placeholder="enter city name">
                  </div>
                  <div class="form-group">
                    <label for="name">Email</label>
                    <input type="email" class="form-control" value="{{$admin->email}}"   id="email" placeholder="enter city name">
                  </div>
                   <div class="form-group">
                    <label for="name">phone</label>
                    <input type="text" class="form-control" value="{{$admin->phone}}"   id="phone" placeholder="enter city name">
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" @if($admin->id ==auth('admin')->user()->id) disabled
                        @endif  class="custom-control-input" id="active">
                      <label class="custom-control-label" for="active">active</label>
                    </div>
                  </div>
                  <button class="btn btn-primary" class="form-control" onclick="update({{$admin->id}},'{{$redirect}}')">update</button>
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
function update(id,ref){
                axios.put('/cms/edit-profile/'+id,{
                    name:document.getElementById('name').value,
                    email:document.getElementById('email').value,
                    phone:document.getElementById('phone').value,
                    active:document.getElementById('active').checked

                })
        .then(function (response) {
            toastr.success(response.data.message)
            if(ref){
             window.location.href="/cms/index"
            }
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
