@extends('cms.parent')
@section('title','title')
@section('styles')

@endsection
@section('page-title','Roles')
@section('main-page-title','Roles')
@section('small-page-title','Roles')
@section('content')
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Roles</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>guard</th>
                      <th>permission_count</th>
                      <th>created_at</th>
                      <th>updated_at</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($roles as $role)
                    <tr>
                      <td>{{$role->id}}</td>
                      <td>{{$role->name}}</td>
                      <td><span class=" badge  bg-success">{{$role->guard_name}}</span></td>
                      <td> <a href="{{route('roles.permissions.index',$role->id)}}" class="btn btn-primary">({{$role->permissions_count}}) permission</a></td>
                       <td>{{$role->created_at}}</td>
                       <td>{{$role->updated_at}}</td>
                    </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
@endsection
@section('scripts')
<script>
    function confirmDestroy(id,ref){
    console.log(id);
     Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
     }).then((result) => {
    if (result.isConfirmed) {
       destroy(id,ref)
    }
})
    }
    function destroy(id,ref){
       axios.delete('/admin/categories/'+id)
        .then(function (response) {
            // handle success
           showMessage(response.data);
           ref.closest('tr').remove();
           console.log(response.data);
        })
        .catch(function (error) {
            // handle error
              showMessage(response.data.error)
            console.log(error);
        })
        .then(function () {
            // always executed
        });
    }
    function showMessage(data){
        Swal.fire({
        icon: data.icon,
        title: data.icon,
        text:data.text,
        showConfirmButton: false,
        timer: 1500
        })
    }

</script>
@endsection
