@if ($errors->any())
    <div class="alert alert-danger">
    <ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
</div>
    <br />
@endif

@if (session('success'))
    <div class="alert alert-success" id="session_message">
        {{ session('success') }}
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-warning" id="session_message">
        {{ session('error') }}
    </div>
    @endif
{{-- @if (session('success'))
                <div class="col-sm-12">
                    <div class="alert  alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                </div>
            @endif  --}}