@extends('common') 

@section('pagetitle')
Products
@endsection

@section('pagename')
Laravel Project
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <img src="{{ Storage::url('images/items/'.$product->picture) }}" alt="{{ $product->title }}" class="product-image" style="margin-left: 100px;">
        </div>
        <div class="col-md-6">
            <h1>{{ $product->title }}</h1>
            <p>{{ $product->description }}</p>
            <p>Price: {{ $product->price }}</p>
            <p>Quantity: {{ $product->quantity }}</p>
            <p>SKU: {{ $product->sku }}</p>
            <button class="btn btn-primary">Buy Now</button>
        </div>
    </div>
@endsection