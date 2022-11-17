@extends('layouts.app')
@section('title')
    @lang('app.product') - @lang('app.app-name')
@endsection
@section('content')
    <div class="container-xl py-4">
        <div class="row justify-content-center">
            <div class="col-10 col-sm-8 col-md-6 col-lg-4">
                <div class="h3 text-center mb-3">
                    @lang('app.product')
                </div>


            </div>
        </div>
    </div>
@endsection