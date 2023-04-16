@extends('common') 

@section('pagetitle')
Products
@endsection

@section('pagename')
Laravel Project
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <h3>Shopping Cart</h3>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Title</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Subtotal</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($cartItems as $item)
        <tr>
          <td>{{ $item->title }}</td>
          <td>
            <form action="{{ route('update_cart', $item->id) }}" method="POST">
              @csrf
              <div class="form-group">
                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->max_quantity }}" class="form-control">
              </div>
              <button type="submit" class="btn btn-primary">Update</button>
            </form>
          </td>
          <td>{{ $item->price }}</td>
          <td>{{ $item->subtotal }}</td>
          <td>
            <form action="{{ route('remove_item', $item->id) }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-danger">Remove</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3"></td>
          <td>Subtotal: {{ $subtotal }}</td>
          <td><a href="{{ route('checkout') }}" class="btn btn-success">Checkout</a></td>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
@endsection