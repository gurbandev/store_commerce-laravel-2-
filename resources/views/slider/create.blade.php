@extends('layouts.app')
@section('title')
    @lang('app.slider') - @lang('app.app-name')
@endsection
@section('content')
    <div class="container-xl py-3">
        <div class="row justify-content-center">
            <div class="col-10 col-sm-8 col-md-6 col-lg-4">
                <div class="h3 text-center mb-3">
                    @lang('app.slider')
                </div>

                <form action="{{ route('sliders.store') }}" method="post">
                    @csrf

                    {{----}}

                    <button type="submit" class="btn btn-primary w-100">
                        @lang('app.save')
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection