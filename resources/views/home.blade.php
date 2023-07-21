@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        @foreach ($classes as $class)
        <div class="col-md-3">
            <div class="card">
                <a href="/c/{{$class[0]->uuid}}">
                    <div class="card-header"> {{ $class[0]->className }} </div>
                </a>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
