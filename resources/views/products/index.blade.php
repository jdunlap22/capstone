@extends('common') 

@section('pagetitle')
Products
@endsection

@section('pagename')
Laravel Project
@endsection


@section('content')

<div class="row">
    <div class="col-md-3">
      <h3>Categories</h3>
      <ul class="list-group">
        @foreach($categories as $category)
        <li class="list-group-item"><a href="{{ route('products.showCategory', $category->id) }}">{{ $category->name }}</a></li>
        @endforeach
      </ul>
    </div>
    <div class="col-md-9">
      <h3>Products</h3>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Product</th>
            <th>Title</th>
            <th>Price</th>
          </tr>
        </thead>
        <tbody>
          @foreach($items as $product)
          <tr>
            <td><a href="{{ route('products.show', $product->id) }}"><img src="{{ Storage::url('images/items/'.$product->picture) }}" alt="{{ $product->title }}" width="100" height="100"></td>
            <td><a href="{{ route('products.show', $product->id) }}">{{ $product->title }}</td>
            <td>{{ $product->price }}</td>
            <td><a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">Buy now</a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection