@extends('frontend.dashboard')

@section('dashboard_content')
<!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <!-- /.card-header -->
                    <div class="card-body pad">
                        <form method="post" action="{{ route('client.story.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title" class="col-form-label">Title<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                            </div>
                            <div class="form-group">
                                <label for="section_id" class="col-form-label">Section</label>
                                <select id="section_id" class="form-control" name="section_id">
                                        <option value="">Select option</option>
                                        @foreach($sections as $sec)
                                            <option value="{{ $sec->id }}">{{ $sec->title }}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tag" class="col-form-label">Tags</label>
                                <input name="tags" type="text" id="input-tags" class="demo-default" value="">
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-form-label">Description<span class="text-danger">*</span></label>
                                <textarea class="textarea" name="description" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image_caption" class="col-form-label">Image Caption<span class="text-danger">*</span></label>
                                <input type="text" id="image_caption" name="image_caption" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="image" class="col-form-label">Image</label>
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
        <!-- ./row -->
    </section>
    <!-- /.content -->
@endsection
@section('js')
    <script>
        $('#input-tags').selectize({
            persist: false,
            createOnBlur: true,
            create: true
        });
    </script>
@endsection
