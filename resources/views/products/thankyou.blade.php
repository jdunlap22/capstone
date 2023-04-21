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
    <h3>Thank You for Your Order</h3>
    <p>Here are your order details:</p>
    <ul>
      <li>First Name: {{ $checkout->first_name }}</li>
      <li>Last Name: {{ $checkout->last_name }}</li>
      <li>Phone: {{ $checkout->phone }}</li>
      <li>Email: {{ $checkout->email }}</li>
      <li>Subtotal: {{ $subtotal }}</li>
    </ul>
  </div>
</div>
@endsection