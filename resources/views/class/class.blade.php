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
                    <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                        <div class="d-flex flex-start w-100">
                          <div class="form-outline w-100">
                            <textarea class="form-control" id="textAreaExample" rows="4"
                              style="background: #fff;"></textarea>
                          </div>
                        </div>
                        <div class="float-end mt-2 pt-1">
                          <button type="button" class="btn btn-primary btn-sm">Post</button>
                          <button type="button" class="btn btn-outline-primary btn-sm">Cancel</button>
                        </div>
                      </div>
                </div>
                <p></p>
                <div class="row justify-content-right">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">{{ __("Stream") }}</div>
                            <div class="card-body"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
