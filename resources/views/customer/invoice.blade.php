@extends('layouts.master')
@section('content')
<div class="container-xxl py-5">
    <div class="container" id="invoiceArea">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4 shadow">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>Service Invoice</h2>
                        <button class="btn btn-primary" onclick="window.print()">Print</button>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <strong>Invoice #: </strong> {{ $invoice->id ?? 'INV-001' }}<br>
                        <strong>Date: </strong> {{ $invoice->created_at ?? date('Y-m-d') }}
                    </div>
                    <div class="mb-3">
                        <strong>Customer Info:</strong><br>
                        Name: {{ $customer->name ?? 'John Doe' }}<br>
                        Email: {{ $customer->email ?? 'john@example.com' }}<br>
                        Phone: {{ $customer->phone ?? '0123456789' }}
                    </div>
                    <div class="mb-3">
                        <strong>Booking Details:</strong><br>
                        Service: {{ $booking->service?->name ?? 'Cleaning Service' }}<br>
                        Date: {{ $booking->booking_date ?? '2025-10-15' }}<br>
                        Address: {{ $booking->address ?? '123 Main St, City' }}
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Service</th>
                                <th>Qty</th>
                                <th>Base Price</th>
                                <th>Unit Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $booking->service_name ?? 'Cleaning Service' }}</td>
                                <td>
                                    @if($booking->distance > 0)
                                        {{ $booking->distance }} km
                                    @elseif($booking->hour > 0)
                                        {{ $booking->hour }} hr
                                    @else
                                        {{ $booking->area_sqft }} sqft
                                    @endif
                                </td>
                                <td>{{ number_format($booking->unit_price ?? 100, 2) }}</td>
                                <td>{{ number_format(($booking->base_price),2) }}</td>
                                <td>{{ number_format($booking->service_price, 2) }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Grand Total</th>
                                <th>{{ number_format($booking->service_price, 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="mt-4">
                        <strong>Thank you for your booking!</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
@media print {
    body * {
        visibility: hidden;
    }
    #invoiceArea, #invoiceArea * {
        visibility: visible;
    }
    #invoiceArea {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
    button {
        display: none !important;
    }
}
</style>
@endsection