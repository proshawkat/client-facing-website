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
                                        <h3 class="card-title">Section list</h3>
                                        <div class="card-tools float-right">
                                            <a data-toggle="modal" data-target="#add-new" href="{{ route('admin.section.create') }}" class="btn btn-success float-right">Add New</a>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th width="30">#</th>
                                                <th>Title</th>
                                                <th class="text-center" width="250">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($sections as $section)
                                                <tr>
                                                    <td>{{ $section->id }}</td>
                                                    <td>{{ $section->title }}</td>
                                                    <td>
                                                        <a onclick="edit({{ $section->id }})" href="#" class="btn btn-success">Edit</a>
                                                        <a href="{{ route('admin.section.destroy', $section->id) }}" class="btn btn-danger">Delete</a>
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

                <form role="form" method="post" action="{{ route('admin.section.store') }}" id="quickForm">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Section</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title<sup class="text-danger">*</sup></label>
                            <input type="text" name="title" class="form-control" id="title"
                                   placeholder="Title">
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

    <div class="modal fade" id="edit-new">
        <div class="modal-dialog">
            <div class="modal-content">

                <form role="form" method="post" action="{{ route('admin.section.update') }}" id="quickForm">
                    @csrf
                    <input type="text" hidden value="" name="id" id="edit_id">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit New Section</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title<sup class="text-danger">*</sup></label>
                            <input type="text" name="title" class="form-control" id="edit_title"
                                   placeholder="Title">
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
@section('js')
    <script>
        function edit(id){
            $('#edit-new').modal('show');
            $('#att_id2').val(id)
            var token = $("input[name='_token']").val();
            $.ajax({
                url: "<?php echo route('admin.section.edit') ?>",
                method: 'POST',
                data: {id:id, _token:token},
                success: function(data) {
                    $("#edit_id").val(data.id);
                    $("#edit_title").val(data.title);
                }
            });
        }
    </script>
@endsection
