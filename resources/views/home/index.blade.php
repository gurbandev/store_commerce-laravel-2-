@extends('layouts.app')
@section('title')
    @lang('app.app-name')
@endsection
@section('content')

    @if($sliders->count() > 0)
        @include('home.sliders')
    @endif

    @foreach($categoryProducts as $categoryProduct)
        @if($categoryProduct['products']->count() > 0)
            @include('home.categories')
        @endif
    @endforeach

@endsection