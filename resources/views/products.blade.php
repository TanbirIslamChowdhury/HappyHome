@extends('layouts.master')


@section('content')



    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-secondary text-uppercase"></h6>
                <h1 class="mb-5">Our  Products</h1>
            </div>
            <div class="row g-4">
                @forelse ($products as $product)
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item">
                            <div class="position-relative overflow-hidden">
                                <img class="img-fluid" src="{{asset('uploads/'.$product->image)}}" alt="image">
                            </div>
                            <div class="team-text">
                                  <div class="bg-light">
                                    <h5 class="fw-bold mb-0">{{$product->name}}</h5>
                                    
                                <h5 class="fw-bold mb-0">{{$product->description}}</h5>
                                
                                    <h5 class="fw-bold mb-0">{{$product->price}}BDT</h5>
                                    
                                </div>
                                <div class="bg-primary">
                                    <a class="btn  mx-1" href="javascript:void(0)" onclick="addToCart({{$product->id}})" >Add to Cart</a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                 @endforelse
                
               
            </div>
        </div>
    </div>

@endsection







{{-- @push('scripts')
    <script>
        function addToCart(productId) {
            // Implement the logic to add the product to the cart
            // You might want to make an AJAX request to your server here
            fetch("{{ route('cart.add') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(response => response.json())
            .then(data => {
                //console.log('Success:', data);
                alert('Product added to cart!');
            })
            .catch((error) => {
                //console.error('Error:', error);
                alert('Failed to add product to cart.');
            });

        }
    </script>
@endpush --}}
