@extends('cms.parent')
@section('title', 'title')
@section('styles')

@endsection
@section('page-title', 'category')
@section('main-page-title', 'category')
@section('small-page-title', 'category')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All admin</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Search">

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
                                        <th>name</th>
                                        <th>email</th>
                                        <th>active</th>
                                        <th>Created_at</th>
                                        <th>Update_at</th>
                                        <th>setting</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $admin)
                                        <tr>
                                            <td>{{ $admin->id }}</td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td><span
                                                    class=" px-2 badge @if ($admin->active == true) bg-success @else bg-danger @endif">active</span>
                                            </td>
                                            {{-- <td> <a href="{{route('user.permission.index',$user->id)}}" class="btn btn-primary"></a></td> --}}
                                            <td>{{ $admin->created_at }}</td>
                                            <td>{{ $admin->updated_at }}</td>
                                            {{-- <td><a href="{{route('admins.edit',$admin->id)}}" class="btn btn-info"><i class="fas fa-edit"></i></a> --}}
                                            {{-- <form class="d-inline" method="post" action="{{route('cities.destroy',$city->id)}}">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" class="form-control"><i class="fas fa-trash-alt"></i></button>
                        </form> --}}
                                            {{-- <button class="btn btn-danger" onclick="confirmDestroy({{$admin->id}},this)"><i class="fas fa-trash-alt"></i></button> --}}
                                            </td>
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
        function confirmDestroy(id, ref) {
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
                    destroy(id, ref)
                }
            })
        }

        function destroy(id, ref) {
            axios.delete('/cms/admin/admins/' + id)
                .then(function(response) {
                    // handle success
                    showMessage(response.data);
                    ref.closest('tr').remove();
                    console.log(response.data);
                })
                .catch(function(error) {
                    // handle error
                    showMessage(response.data.error)
                    console.log(error);
                })
                .then(function() {
                    // always executed
                });
        }

        function showMessage(data) {
            Swal.fire({
                icon: data.icon,
                title: data.icon,
                text: data.text,
                showConfirmButton: false,
                timer: 1500
            })
        }
    </script>
@endsection
