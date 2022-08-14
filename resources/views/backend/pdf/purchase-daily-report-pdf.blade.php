<!DOCTYPE html>
<html>
<head>
    <title>Daily Invoice Report</title>
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{asset('/')}}backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table width="100%">
                <tbody>
                <tr>
                    {{--                    <td><strong>Invoice No: # {{$invoice->invoice_no}}</strong></td>--}}
                    <td><span style="font-size: 20px; background-color: #ddd;">Fakir Knitwears ltd.</span><br/>
                        <span style="font-size: 12px;">Fatullah, Narayanganj<br>Phone: 012345678, 1023450</span></td>
                    {{-- <td><span>Showroom No: 01676902988</span></td> --}}
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <hr/>
    <br/>
    <div class="row">
        <div class="col-md-12>">
            <table>
                <tbody>
                <tr>
                    <td width="25%"></td>
                    <td><u><strong>Daily Invoice Report ({{date('d-m-Y',strtotime($start_date))}}-{{date('d-m-Y',strtotime($end_date))}})</strong></u></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-12">
            <table border="1" width="100%" >
                <thead>
                <tr>
                    <th>SL.</th>
                    <th>Purchase No</th>
                    <th>Date</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Buying Price</th>
                </tr>
                </thead>
                <tbody>
                @php
                $total_sum = '0';
                @endphp
                @foreach($allData as $key => $purchase)
                    <tr>
                        <td>{{$key +1}}</td>
                        <td>{{$purchase->purchase_no}}</td>
                        <td>{{date('d-m-y',strtotime($purchase->date))}}</td>
                        <td>{{$purchase['product']['name']}}</td>
                        <td>{{$purchase->buying_qty}}
                            {{$purchase['product']['unit']['name']}}</td>
                        <td>{{$purchase->unit_price}}</td>
                        <td>{{$purchase->buying_price}}</td>
                        @php
                    $total_sum += $purchase->buying_price;
                        @endphp
                    </tr>
                @endforeach
                <tr>
                    <td colspan="6" style="text-align: right"><strong>Grand Total</strong></td>
                    <td>{{$total_sum}}</td>
                </tr>
                </tbody>
            </table>
            <br/>
        </div>
    </div>
    <br/>
    @php
        $date = new DateTime('now',new DateTimeZone('Asia/Dhaka'));
    @endphp
    <i>Printing Time: {{$date->format('j F Y, g:i a')}}</i>
</div>
</body>
</html>


