@extends('layouts.app')

@section('title','Wishlist')

@section('content')

@include('partials.breadcrumbs', $data = array('Cart' => ''))

<script src={{ asset('js/cart.js') }} defer></script>

<main>
    <div class="container">
        <h1>My Cart</h1>
        <div class="section-container">
            @foreach($products as $product)
                <div class="cart-item row">
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12 col-xs-12 pb-lg-0 pb-md-0 pb-sm-3">
                        <div class="d-flex flex-column align-items-center cart_item_img">
                            <img src="{{$product->photos->get(0)->path}}" alt="Item 1" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-xl-10 col-lg-10 col-md-9 col-sm-12 col-xs-12">
                        <div class="info-item d-flex flex-column">
                            <h5>{{ $product->name }}</h5>
                            <div class="d-flex flex-row cart-item-quantity">
                                <p>Quantity:</p>
                                    <p><i onclick="decrement(this, {{ $product->quantity_available }})" class="fas fa-minus"></i></p>
                                    <input type="number" class="item_quantity" value="{{ $product->pivot->quantity }}" data-value="{{ $product->quantity_available }}" data-id="{{ $product->id }}">
                                    <p><i onclick="increment(this, {{ $product->quantity_available }})" class="fas fa-plus"></i></p>
                            </div>
                            <div class="remove-item-cart mt-auto d-flex align-items-end">
                                <a class="mr-auto mt-auto" href="" onclick="return deleteProduct(this, {{ $product->id }})">Remove</a>
                                <div class="info-item ">
                                    <p class="mb-auto">{{ $product->price }} €</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
            @endforeach
        
            <div id="end_cart" class="col-12 d-flex justify-content-end align-items-center">
                <p class="subtotal">Subtotal before delivery: </p>
                <p class="subtotal_price">{{ $total }} €</p>
            </div>
            <div id="checkout_cart" class="d-flex flex-row justify-content-end">
                <input type="button" class="black-button" value="Checkout" data-toggle="modal" data-target="#checkoutModal">
            </div>
            <p id="info_message">*The stock may change during this procedure.</p>

            <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <form class="modal-content" method="POST" action="{{ route('checkout') }}">
                        {{ csrf_field() }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Checkout</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body section-container mt-0 d-flex flex-column">
                            <h6>Delivery Address</h6>
                            <select id="delivery_address" name="delivery_address" required>
                                <option disabled selected value>Choose Address</option>
                                @foreach($addresses as $address)
                                    <option value="{{ $address->id }}">{{ $address->name }} - {{ $address->street }}, {{ $address->postal_code }} {{ $address->city->name }}, {{ $address->city->country->name }} </option>
                                @endforeach
                            </select>
                            <h6>Subtotal before Delivery</h6>
                            <p class="subtotal_price">{{ $total }} €</p>
                            <h6>Delivery Type</h6>
                            <select id="delivery_type" name="delivery_type" onchange="update_total(this.options[this.selectedIndex])" required>
                                <option disabled selected value>Choose Delivery Type</option>
                                @foreach($delivery_types as $delivery)
                                    <option value="{{ $delivery->id }}" data="{{ $delivery->price }}">{{ $delivery->name }} (+ {{ $delivery->price }} €)</option>
                                @endforeach
                            </select>
                            <h6 class="ml-auto">Total</h6>
                            <input type="hidden" id="total_price_input" name="total_price" value="{{ $total }}">
                            <p id="total_price" class="ml-auto">{{ $total }} €</p>
                        </div>
                        <div class="modal-footer">
                            <input type="button" data-dismiss="modal" value="Close">
                            <input type="submit" class="black-button" value="Purchase">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
    
@endsection