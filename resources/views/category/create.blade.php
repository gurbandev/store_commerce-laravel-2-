@extends('layouts.app')
@section('title')
    @lang('app.category') - @lang('app.app-name')
@endsection
@section('content')
    <div class="container-xl py-3">
        <div class="row justify-content-center">
            <div class="col-10 col-sm-8 col-md-6 col-lg-4">
                <div class="h3 text-center mb-3">
                    @lang('app.category')
                </div>

                <form action="{{ route('categories.store') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="name_tm" class="form-label fw-semibold">
                            <span class="text-primary">TM</span> @lang('app.name')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('name_tm') is-invalid @enderror" name="name_tm" id="name_tm" required autofocus>
                        @error('name_tm')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name_en" class="form-label fw-semibold">
                            <span class="text-primary">EN</span> @lang('app.name')
                        </label>
                        <input type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en" id="name_en">
                        @error('name_en')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="product_tm" class="form-label fw-semibold">
                            <span class="text-primary">TM</span> @lang('app.product')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('product_tm') is-invalid @enderror" name="product_tm" id="product_tm" required>
                        @error('product_tm')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="product_en" class="form-label fw-semibold">
                            <span class="text-primary">EN</span> @lang('app.product')
                        </label>
                        <input type="text" class="form-control @error('product_en') is-invalid @enderror" name="product_en" id="product_en">
                        @error('product_en')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="sort_order" class="form-label fw-semibold">
                            @lang('app.sortOrder')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="number" min="1" class="form-control @error('sort_order') is-invalid @enderror" name="sort_order" id="sort_order" required>
                        @error('sort_order')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="1" name="home" id="home">
                        <label class="form-check-label" for="home">
                            @lang('app.showOnHomePage')
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        @lang('app.save')
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection