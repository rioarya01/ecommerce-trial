@extends('template.layouts')
@section('title', 'Cart Page')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 pt-2">
            <h1>Cart Page</h1>
            <p>Ini adalah halaman cart</p>
        </div>
        <div class="col-12">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if(isset($cartItems) && $cartItems->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>Rp{{ number_format($item->product->price, 0, ',', '.') }}</td>
                                <td>
                                    <form method="POST" action="{{ route('cart.update', $item->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control d-inline-block w-auto">
                                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                    </form>
                                </td>
                                <td>Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                                <td>
                                    <form method="POST" action="{{ route('cart.destroy', $item->id) }}" onsubmit="return confirm('Are you sure you want to remove this item from the cart?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Checkout Button --}}
                <a href="{{ route('checkout') }}" class="btn btn-primary">Proceed to Checkout</a>
            @else
                <p>Your cart is empty.</p>
            @endif
    </div>
</div>
@endsection