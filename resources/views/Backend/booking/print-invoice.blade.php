@extends('Backend.app')
@section('title','Online Avenue - Print Invoice')
@section('content')
<style>
   @media print {
    body * {
        visibility: hidden;
    }
    #print, #print * {
        visibility: visible;
    }
    #print {
        position: absolute;
        left: 0;
        right: 20px;
        top: 0;
        width: 90%;
    }
    #print_Button {
        display: none !important; 
    }
}

</style>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Print Invoice</h6>
        </div>
        <div class="row row-sm">
            <div class="col-md-12 col-xl-12">
                <div class="main-content-body-invoice" id="print">
                    <div class="card card-invoice">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md">
                                    <label class="tx-gray-600">Invoice Info</label>
                                    <p class="invoice-info-row"><span>Serial No :</span><span> {{$bookings->serial_no}}</span></p>
                                    <p class="invoice-info-row"><span>Booking Date :</span><span>{{$bookings->booking_date}}</span></p>
                                </div>
                            </div>
                            <div class="table-responsive mg-t-30">
                                <table class="table table-invoice border text-md-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th class="wd-20p">#</th>
                                            <th class="tx-center">Avenues Name</th>
                                            <th class="tx-right">Customers Name</th>
                                            <th class="tx-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td class="tx-center">{{ $bookings->avenues->name }}</td>
                                            <td class="tx-right">{{  $bookings->customers->name }}</td>
                                            <td class="tx-right">{{ $bookings->total }}</td>
                                        </tr>
                                        <tr>
                                            <td class="valign-middle" colspan="2" rowspan="4">
                                                <div class="invoice-notes">
                                                    <label class="main-content-label tx-13">#</label>
                                                </div>
                                            </td>
                                            <td class="tx-right">Subtotal</td>
                                            <td class="tx-right" colspan="2"> {{ $bookings->subtotal }}</td>
                                        </tr>
                                        <tr>
                                            <td class="tx-right">Tax</td>
                                            <td class="tx-right" colspan="2">{{ $bookings->tax}}</td>
                                        </tr>
                                        <tr>
                                            <td class="tx-right tx-uppercase tx-bold tx-inverse">Total</td>
                                            <td class="tx-right" colspan="2">
                                                <h4 class="tx-primary tx-bold">{{$bookings->total}}</h4>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <button class="btn btn-danger float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i class="mdi mdi-printer ml-1"></i>Print</button>
                        </div>
                    </div>
                </div>
            </div><!-- COL-END -->
        </div>
    </div>
</div>

<!--Internal Chart.bundle js -->
<script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>

<script type="text/javascript">
    function printDiv() {
        window.print();
    }
</script>
@endsection
