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

                                        <div class="card-tools">
                                            <form action="{{ route('admin.client.search') }}" method="post">
                                                @csrf
                                                <div class="input-group input-group-sm" style="width: 350px;">
                                                    <input type="text" name="search" class="form-control float-right" placeholder="Search by name, email, phone, gender">

                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </form>
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
                                                <th>Phone</th>
                                                <th>Date Of Birth</th>
                                                <th>Gender</th>
                                                <th width="100">Image</th>
                                                <th width="50">Status</th>
                                                <th class="text-center" width="250">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $user)
                                                <tr>
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->phone }}</td>
                                                    <td>{{ $user->date_of_birth }}</td>
                                                    <td>{{ $user->gender }}</td>
                                                    <td><img style="height: 100px;" src="{{ url('storage/client', $user->avatar) }}" alt=""></td>
                                                    <td>
                                                        @if($user->status == 1)
                                                            <span class="badge badge-success">Active</span>
                                                        @else
                                                            <span class="badge badge-danger">Blocked</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.client.active', $user->id) }}" class="btn btn-success">Active</a>
                                                        <a href="{{ route('admin.client.block', $user->id) }}" class="btn btn-danger">Block</a>
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
@endsection

