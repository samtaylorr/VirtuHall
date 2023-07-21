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
                    <div class="card-body">{{ $uuid }}</div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __("Linking Code") }}</div>
                    <div class="card-body">{{ $uuid }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
