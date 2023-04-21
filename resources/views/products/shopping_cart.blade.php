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
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($cartItems as $item)
        <tr>
          <td>{{ $item->item->title }}</td>
          <td>
            <form action="{{ route('cart.update', $item->id) }}" method="POST">
                @csrf
                @method('GET')
                <div class="input-group mb-3">
                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="submit">Update</button>
                    </div>
                </div>
            </form>
          </td>
          <td>{{ $item->item->price }}</td>
          <td>
            <form action="{{ route('cart.delete', $item->id) }}" method="POST">
              @csrf
              @method('DELETE')
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
        </tr>
        <tr>
          <td colspan="4">
            <h4>Customer Information</h4>
            <form action="{{ route('cart.checkOut') }}" method="POST" data-parsley-validate>
              @csrf
              <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control" required>
                @if ($errors->has('first_name'))
                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" required>
                @if ($errors->has('last_name'))
                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" required>
                @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-success">Submit Order</button>
        </form>
          </td>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
@endsection






