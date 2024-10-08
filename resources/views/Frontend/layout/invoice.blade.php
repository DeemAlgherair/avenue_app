@extends('frontend.layout.app')
@section('title','HALL Plus - Invoice')

@section('content')
<link rel="stylesheet" href="{{asset('Frontend/assets/css/invoice.css')}}">

<section class="container">
    <div class=" container container1 py-5" id="print">
        <div class="row justify-content-center">
            <div class="col-24 col-md-16 col-lg-12">
                <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                    <div class="card-header bg-gradient-primary text-white border-0 d-flex justify-content-between align-items-center">
                        <h3 class="text-start mb-0">Invoice</h3>
                        <a href="{{ url()->previous() }}" class="btn btn-outline-light">Back</a>
                    </div>
                <div class="card-body " >
                    <div class="row mb-3">
                        <div class="col-12">
                            <h4>From</h4>
                            <address>
                                <strong>Hall plus Lecture Hall Reservation</strong><br>
                                Phone: (966) 0505130147<br>
                                Email: HullPlus@gmail.com
                            </address>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-6 col-md-8">
                            <h4>Bill To</h4>
                            <address>
                                <strong>{{ $booking->customers->name }}</strong><br>
                                Phone: {{ $booking->customers->phone }}<br>
                                Email: {{ $booking->customers->email }}
                            </address>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <h4>Invoice Details</h4>
                            <p>
                                Booking #: {{ $booking->serial_no }}<br>
                                Invoice Date: {{ \Carbon\Carbon::parse($booking->created_at)->format('d-m-Y') }}<br>
                                Start Date: {{ \Carbon\Carbon::parse($booking->startDate)->format('d-m-Y') }}<br>
                                End Date: {{ \Carbon\Carbon::parse($booking->endDate)->format('d-m-Y') }}<br>

                            </p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-uppercase">Hall Name</th>
                                            <th scope="col" class="text-uppercase text-end">Price</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        <tr>
                                            <td>{{ $booking->avenues->name }}</td>
                                            <td class="text-end">{{ $booking->avenues->price_per_hours }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" class="text-end">Subtotal</td>
                                            <td class="text-end">{{ $booking->subtotal }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" class="text-end">VAT (5%)</td>
                                            <td class="text-end">{{ $booking->tax }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" class="text-uppercase text-end">Total</td>
                                            <td class="text-end">{{ $booking->total }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-end d-flex">
                            @if($booking->status_id == 3)
                            <button type="button" id="print_Button" class="btn btn-primary mb-3" onclick="printDiv()"><i class="mdi mdi-printer ml-1"></i>Print</button>
                            @endif
                            @if($booking->status_id != 3)
                            <form action="{{ route('bookings.success', ['booking' => $booking->id]) }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-primary mb-3">Submit Payment</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
<script type="text/javascript">
    function printDiv() {
        window.print();
    }
</script>
@endsection
