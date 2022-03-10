@extends('layouts.app')
@section("title", $viewData["title"])
@section("subtitle", $viewData["subtitle"])
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
    <h1>Available products</h1>
    <ul>
      @foreach($viewData["products"] as $key => $product)
        <li>
          Id: {{  $product->getId() }} - 
          Name: {{ $product->getName() }} -
          Price: {{ $product->getPrice() }} -
          <a href="{{ route('cart.add', ['id'=> $product->getId() ]) }}">Add to cart</a>
        </li>
      @endforeach
    </ul>
    </div>
  </div>

  <a href="{{ route('cart.purchase') }}">Comprar</a>

  <div class="row justify-content-center">
    <div class="col-md-12">
    <h1>Products in cart</h1>
      <ul>
        @foreach($viewData["productsInCart"] as $key => $product)
          <li>
            Id: {{  $product->getId() }} - 
            Name: {{ $product->getName() }} -
            Price: {{ $product->getPrice() }}
          </li>
        @endforeach
      </ul>
      <a href="{{ route('cart.removeAll') }}">Remove all products from cart</a>
    </div>
  </div>
</div>
@endsection
