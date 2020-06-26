@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session()->has('message'))
    <?php
    $alertType = [
        'info'  =>  'info',
        'success'  =>  'success',
        'error'  =>  'danger',
    ];
    ?>
    <div class="alert alert-{!! $alertType[session()->get('alert','success')] !!}" role="alert">
        @if (session()->get('alert') == 'info')
            <div class="alert-icon">
                <i class="zmdi zmdi-alert-circle"></i>
            </div>
        @elseif (session()->get('alert') == 'error')
            <div class="alert-icon">
                <i class="zmdi zmdi-block"></i>
            </div>
        @else
            <div class="alert-icon">
                <i class="zmdi zmdi-thumb-up"></i>
            </div>
        @endif
        {{ session()->get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">
                <i class="zmdi zmdi-close"></i>
            </span>
        </button>
    </div>
@endif
