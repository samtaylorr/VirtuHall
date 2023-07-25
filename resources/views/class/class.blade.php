@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="height:100px;">{{ $className }}</div>
                </div>
            </div>
        </div>
        <p></p>
        <div class="row justify-content-left">
            <div class="col-md-2">
                <div class="card">
                    <div class="card-header">{{ __("Linking Code") }}</div>
                    <div class="card-body">{{ $linkingCode }}</div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __("Post an announcement") }}</div>
                    <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">                     <div class="d-flex flex-start w-100">
                        <form class ="form-outline w-100" method="POST" action="{{ action([\App\Http\Controllers\PythonAPIController::class, 'upload']) }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="classId" value="{{ $id }}"/>
                            <textarea name="post" class="form-control" id="textAreaExample" rows="4"
                            style="background: #fff;"></textarea>
                            <p></p>
                            <div class="float-start inline">
                                <input type="file" class="form-control @error('file') is-invalid @enderror" name="document"/>
                            </div>
                            <div class="float-end inline">
                            <button type="submit" class="btn btn-primary btn-sm">Post</button>
                            <button type="button" class="btn btn-outline-primary btn-sm">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
                <p></p>
                <div class="row justify-content-right">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">{{ __("Stream") }}</div>
                            <div class="card-body">
                                @foreach ($posts as $post)
                                    <div class="card">
                                        <div class="card-header">{{$users[$i++]}} commented</div>
                                        <div class="card-body">
                                            @if($post->post != null)
                                                {{ $post->post }}
                                            @endif
                                            @if($post->file != null)
                                                <img src={{ $post->file }} width=250 />
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection