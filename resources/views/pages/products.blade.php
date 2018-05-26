@extends('layouts.app')

@section('title','Faq')

@section('content')

@include('partials.breadcrumbs', $data = array($category->name => ''))

<script type="text/javascript" src={{ asset('js/products.js') }} defer></script>

<main>
    <div class="container">
    <div class="products d-flex justify-content-between align-items-center flex-wrap">
            <h1>{{ $category->name }}</h1>
            <span>{{ $products->total() }} Products</span>
            <div class="dropdown show">
                <a id="dropdownSort" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort by</a>
                <div id="dropdown-sortby" class="dropdown-menu" aria-labelledby="dropdownSort">
                    @include('partials.products.dropdown')
                </div>
            </div>
            <nav class="pagination-links" aria-label="Page navigation">
                @include('partials.products.pagination')
            </nav>
        </div>
        <hr>
        <div class="row">
            <div id="filter-listing" class="mt-4 col-md-4 col-lg-3">
                @include('partials.products.filters')
            </div>
            <div class="col-md-8 col-lg-9">
                <div id="product-listing" class="row">
                    @include('partials.products.product')
                </div>
            </div>
        </div>
        <nav class="mt-4 d-flex justify-content-end pagination-links" aria-label="Page navigation">
            @include('partials.products.pagination')
        </nav>
    </div>
</main>
@endsection