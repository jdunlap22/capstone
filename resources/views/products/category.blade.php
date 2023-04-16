@extends('common') 

@section('pagetitle')
Products
@endsection

@section('pagename')
Laravel Project
@endsection

<h1>{{ $category->name }}</h1>

<!-- Display all products in this category in a table -->
<table>
    <thead>
        <tr>
            <th>Product</th>
            <th>Title</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td><a href="{{ route('public.showProduct', $product->id) }}"><img src="{{ $product->thumbnail_url }}" alt="{{ $product->title }}"></a></td>
                <td>{{ $product->title }}</td>
                <td>{{ $product->price }}</td>
            </tr>
        @endforeach
    </tbody>
</table>