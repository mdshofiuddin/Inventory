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
            <table style="border: 1px solid #000;" width="100%" >
                <thead>
                <tr>
                    <th>SL.</th>
                    <th>Customer Name</th>
                    <th>Invoice No</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                @php
                $total_sum = '0';
                @endphp
                @foreach($allData as $key => $invoice)
                    <tr>
                        <td>{{$key +1}}</td>
                        {{--<td>{{$purchase->purchase_no}}</td>--}}
                        <td>{{$invoice['payment']['customer']['name']}}
                            ({{$invoice['payment']['customer']['mobile_no']}}-{{$invoice['payment']['customer']['address']}})
                        </td>
                        <td>Invoice No #{{$invoice->invoice_no}}</td>
                        <td>{{date('d-m-y',strtotime($invoice->date))}}</td>
                        <td>{{$invoice->description}}</td>
                        <td>{{$invoice['payment']['total_amount']}}</td>
                        @php
                        $total_sum += $invoice['payment']['total_amount'];
                        @endphp
                    </tr>
                @endforeach
                <br/>
                <hr/>
                <tr>
                    <td colspan="5">Grand Total</td>
                    <td>{{$total_sum}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <br/>
        <div class="col-md-12">
            <br/>
            <br/>
            <br/>
            <br/>
{{--            <hr style="margin-bottom: 0px; padding-top: 30px;">--}}
            <table border="0px" width="100%">
                <tbody>
                <tr>
                    <td width="40%" style="text-align: center"></td>
                    <td width="20%"></td>
                    <td width="40%" style="text-align: center"><p style="text-align: right; border-top: 1px solid #000;">Owner Signature</p></td>
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

