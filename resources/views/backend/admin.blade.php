@extends('layouts.app')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="content-wrapper">
                @include('message')
                <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0 text-dark">User List</h1>
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item active">User</li>
                                    </ol>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">User list</h3>

                                        <div class="card-tools float-right">
                                            <a data-toggle="modal" data-target="#add-new" href="#" class="btn btn-success float-right">Add New</a>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th width="30">#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th class="text-center" width="250">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $user)
                                                <tr>
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.user.destroy', $user->id) }}" class="btn btn-danger {{ Auth::user()->id == $user->id ? 'disabled' : '' }}">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="add-new">
        <div class="modal-dialog">
            <div class="modal-content">

                <form role="form" method="post" action="{{ route('admin.user.store') }}" id="quickForm">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Section</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name<sup class="text-danger">*</sup></label>
                            <input type="text" name="name" class="form-control" id="name"
                                   placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email<sup class="text-danger">*</sup></label>
                            <input type="email" name="email" class="form-control" id="email"
                                   placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password<sup class="text-danger">*</sup></label>
                            <input type="password" name="password" class="form-control" id="password"
                                   placeholder="Password">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

