@if(session('message') || session('title'))
    <div class="alert {{ session('class') }} alert-dismissible fade show" role="alert">
        <strong>{{ session('title') }}</strong>
        {{ session('message') }}
        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span></button>
    </div>
@endif
