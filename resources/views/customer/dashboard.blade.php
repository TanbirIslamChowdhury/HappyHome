@extends('layouts.master')
@section('content')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                
                <h1 class="mb-5">Dashboard</h1>
            </div>



            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        Order History
                        <div class="table-responsive">
                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="text-dark">
                                        <th scope="col">#</th>
                                        <th scope="col">Service</th>
                                        <th scope="col">Provider</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Booking Date</th>
                                        <th>Invoice</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $booking)
                                    <tr>
                                        <td>{{$booking->id}}</td>
                                        <td>{{$booking->service->name}}</td>
                                        <td>
                                            @if($booking->provider)
                                                {{$booking->provider->name}}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if($booking->status=='pending')
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @elseif($booking->status=='confirmed')
                                                <span class="badge bg-info text-dark">Confirmed</span>
                                            @elseif($booking->status=='in_progress')
                                                <span class="badge bg-primary text-dark">In Progress</span>
                                            @elseif($booking->status=='completed')
                                                <span class="badge bg-success text-dark">Completed</span>
                                            @elseif($booking->status=='cancelled')
                                                <span class="badge bg-danger text-dark">Cancelled</span>
                                            @endif
                                        </td>
                                        <td>{{date('d M, Y', strtotime($booking->booking_date))}}</td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="{{route('customer_panel.invoice', $booking->id)}}">View Invoice</a>
                                        </td>   
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>


@endsection