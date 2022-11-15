@extends('layouts.app')
@section('title')
    @lang('app.contact')
@endsection
@section('content')
    <div class="container-xl py-3">
        <div class="row justify-content-center">
            <div class="col-8 col-sm-6 col-md-4 col-lg-3">
                <div class="h3 text-center mb-3">
                    @lang('app.contact')
                </div>

                <form action="{{ route('contacts.store') }}" method="post">
                    @csrf

                    {{----}}

                    <button type="submit" class="btn btn-primary w-100">
                        @lang('app.send')
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection