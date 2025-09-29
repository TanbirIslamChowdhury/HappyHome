

     @extends('layouts.master')

    @section('content')


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-2 text-light mb-4 animated slideInDown">Cart</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item text-dark" aria-current="page">Cart</li> --}}
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="section-title">
                        <p class="fs-5 fw-medium fst-italic text-primary">Your Cart</p>
                        <h1 class="display-6">Items in Your Shopping Cart</h1>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $id=>$item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>BDT{{ number_format($item['price'], 2) }}</td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm" onclick="updateCart({{$id}},'decrease')">-</button>
                                        <input type="number" name="" id="" value="{{ $item['quantity'] }}" style="width: 40px; text-align: center;" readonly>
                                    <button type="button" class="btn btn-secondary btn-sm" onclick="updateCart({{$id}},'increase')">+</button>
                                </td>
                                <td>BDT{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteItem({{$id}})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    
                    <div class="section-title">
                        <p class="fs-5 fw-medium fst-italic text-primary">Cart Summary</p>
                        <h1 class="display-6">Order Summary</h1>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Subtotal
                            <span>
                                BDT {{ number_format(collect($cart)->sum(function($item) { return $item['price'] * $item['quantity']; }), 2) }}
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Discount
                            <span>

                                @if(isset(session()->get('coupon')['discount_amount']))
                                    BDT {{ number_format(session()->get('coupon')['discount_amount'], 2) }}
                                @else
                                    BDT 0.00
                                @endif
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total
                            <span>
                                 @if(isset(session()->get('coupon')['total_after_discount']))
                                    BDT {{ number_format(session()->get('coupon')['total_after_discount'], 2) }}
                                @else
                                    BDT {{ number_format(collect($cart)->sum(function($item) { return $item['price'] * $item['quantity']; }), 2) }}
                                @endif
                            </span>
                        </li>
                    </ul>
                    <a href="{{route('checkout')}}" class="btn btn-primary w-100 mt-3">Proceed to Checkout</a>
                </div>

            </div>
        </div>
    </div>
    <!-- About End -->
    @endsection

@push('scripts')
<script>
    function deleteItem(id) {
        let url = "{{ route('cart.remove', '') }}/" + id;
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        fetch(url, {
            method: 'get',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            }
        }).then(response => response.json())
        .then(data => {
            console.log(data);
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
    function updateCart(id, action) {
        let url = "{{ route('cart.update') }}";
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({
                product_id: id,
                action: action
            })
        }).then(response => response.json())
        .then(data => {
            console.log(data);
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

     
</script>
@endpush
