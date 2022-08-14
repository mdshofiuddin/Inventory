<!DOCTYPE html>
<html>
<head>
	<title>Invoice PDF</title>
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
                    <td><strong>Invoice No: # {{$invoice->invoice_no}}</strong></td>
                    <td><span style="font-size: 20px; background-color: #ddd;"> Fakir Knitwears ltd.</span><br/>
                    <span style="font-size: 12px">Kayempur, Fatullah, Narayanganj <br> Phone: 0123456789, 23541025</span></td>
                    {{-- <td><span>Showroom No: 01676902988</span></td> --}}
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-12>">
            <table>
                <tbody>
                <tr>
                    <td width="45%"></td>
                   <td><u><strong>Customer Invoice</strong></u></td>
                    <td width="30%"></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-12">
            @php
                $payment = \App\Model\Payment::where('invoice_id',$invoice->id)->first();
            @endphp

            <table width="100%">
                <tbody>
                <tr>
                    <td width="30%"><strong>Name: </strong> {{$payment['customer']['name']}}</td>
                    <td width="30%"><strong>Mobile No: </strong> {{$payment['customer']['mobile_no']}}</td>
                    <td width="40%"><strong>Address: </strong> {{$payment['customer']['address']}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-12">
            <table width="100%" border="1" style="margin-bottom: 10px;">
                <thead>
                <tr>
                    <th  class="text-center">SL.</th>
                    <th  class="text-center">Product Name</th>
                    <th  class="text-center">Quantity</th>
                    <th  class="text-center">Unit Price</th>
                    <th  class="text-center">Total Price</th>
                    {{-- <th  class="text-center">Summary</th> --}}
                </tr>
                </thead>
                <tbody>
                @php
                    $total_sum = '0';
                @endphp
                @foreach($invoice['invoice_details'] as $key => $details )
                    <tr>
                        <td  style="padding: 1px"  class="text-center">{{$key+1}}</td>
                        <td  style="padding: 1px"  class="text-center">{{$details['product']['name']}}</td>
                        <td  style="padding: 1px"  class="text-center">{{$details->selling_qty}}</td>
                        <td  style="padding: 1px"  class="text-center">{{$details->unit_price}}</td>
                        <td  style="padding: 1px"  class="text-center">{{$details->selling_price}}</td>
                    </tr>
                    @php
                        $total_sum += $details->selling_price;
                    @endphp
                @endforeach
                <tr>
                    <td colspan="4" class="text-sm-right"><strong>Sub Total</strong></td>
                    <td class="text-center"><strong>{{$total_sum}}</strong></td>
                </tr>
                <tr>
                    <td class="text-right" colspan="4">Discount</td>
                    <td class="text-center"><strong>{{$payment->discount_amount}}</strong></td>
                </tr>
                <tr>
                    <td class="text-right" colspan="4">Paid Amount</td>
                    <td class="text-center"><strong>{{$payment->paid_amount}}</strong></td>
                </tr>
                <tr>
                    <td class="text-right" colspan="4">Due Amount</td>
                    <td class="text-center"><strong>{{$payment->due_amount}}</strong></td>
                </tr>
                <tr>
                    <td class="text-right" colspan="4"><strong>Grand Total</strong></td>
                    <td class="text-center"><strong>{{$payment->total_amount}}</strong></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br/>
    <br/>
    <div class="row">
        <br/>
        <div class="col-md-12">
            <hr style="margin-bottom: 0px; padding-top: 30px;">
            <table border="0px" width="100%">
                <tbody>
                <tr>
                    <td width="40%" style="text-align: center"><p style="text-align: left">Customer Signature</p></td>
                    <td width="20%"></td>
                    <td width="40%" style="text-align: center"><p style="text-align: right">Seller Signature</p></td>
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
