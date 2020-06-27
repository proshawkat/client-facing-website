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
                                    <h1 class="m-0 text-dark">Story List</h1>
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item active">Story</li>
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
                                        <h3 class="card-title">Story list</h3>

                                        <div class="card-tools">
                                            <form action="{{ route('admin.story.search') }}" method="post">
                                                @csrf
                                                <div class="input-group input-group-sm" style="width: 350px;">
                                                    <input type="text" value="{{ old('search') }}" name="search" class="form-control float-right" placeholder="Search by title, body, section, and tags">

                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                    </div>

                                                    <div class="input-group-append ml-3">
                                                        <a href="{{ route('admin.manage_post') }}" class="btn btn-success float-right">Reset</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th width="30">#</th>
                                                <th>Posted By</th>
                                                <th>Section</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th width="100">Image</th>
                                                <th width="50">Status</th>
                                                <th class="text-center" width="100">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($stories as $story)
                                                    <tr>
                                                        <td>{{ $story->id }}</td>
                                                        <td>{{ $story->client->name }}</td>
                                                        <td>{{ $story->section->title }}</td>
                                                        <td>{{ $story->title }}</td>
                                                        <td>{!! $story->description !!}</td>
                                                        <td><img style="height: 100px;" src="{{ url('storage/stories', $story->img) }}" alt=""></td>
                                                        <td>
                                                            @if($story->status == 0)
                                                                <span class="badge badge-success">Active</span>
                                                            @elseif($story->status == 1)
                                                                <span class="badge badge-danger">Blocked</span>
                                                            @else
                                                                <span class="badge badge-danger">Unlisted</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    Action
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                    <a href="{{ route('admin.story.details', $story->id) }}" class="dropdown-item btn btn-success">View Details</a>
                                                                    <a href="{{ route('admin.story.active', $story->id) }}" class="dropdown-item btn btn-success">Active</a>
                                                                    <a href="{{ route('admin.story.block', $story->id) }}" class="dropdown-item btn btn-info">Block</a>
                                                                    <a href="{{ route('admin.story.unlisted', $story->id) }}" class="dropdown-item btn btn-danger">Unlisted</a>
                                                                </div>
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

