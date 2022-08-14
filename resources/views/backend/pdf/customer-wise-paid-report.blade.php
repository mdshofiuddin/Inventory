<!DOCTYPE html>
<html>
<head>
   <!--  <title>Customer wise Paid Report</title> -->
    <!-- Tempusdominus Bbootstrap 4 -->
   <!--  <link rel="stylesheet" href="{{asset('/')}}backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"> -->
</head>
<!-- <body> -->

<!-- <div class="container">
    <div class="row">
        <div class="col-md-12">
            <table width="100%">
                <tbody>
                <tr>
                    <td><span style="font-size: 20px; background-color: #ddd;">ABC Shopping Mall</span><br/>
                        Fatullah, Narayanganj</td>
                    <td><span>Showroom No: 01676902988</span></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <hr/>
    <br/>
    <div class="row">
        <div class="col-md-12>">
            <table width="100%">
                <tbody>
                <tr>
                    <td width="38%"></td>
                    <td><u><strong><span style="font-size: 15px;">Customer wise Paid report</span></strong></u></td>
                </tr>
                </tbody>
            </table>
            <table border="1" width="100%">
                <thead>
                <tr>
                    <th>SL.</th>
                    <th>Customer Name</th>
                    <th>Invoice No</th>
                    <th>Date</th>
                    <th>Paid Amount</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $total_paid = '0';
                @endphp
                @foreach($allData as $key => $payment)
                    <tr>
                        <td>{{$key +1}}</td>
                        <td>{{$payment['customer']['name']}} ({{$payment['customer']['address']}}-{{$payment['customer']['mobile_no']}})</td>
                        <td>Invoice No: #{{$payment['invoice']['invoice_no']}}</td>
                        <td>{{date('d-m-Y', strtotime($payment['invoice']['date']))}}</td>
                        <td>{{$payment->paid_amount}} Tk</td>
                        @php
                            $total_paid += $payment->paid_amount;
                        @endphp
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" style="text-align: right"><strong>Grand Total</strong></td>
                    <td>{{$total_paid}} Tk</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br/>
    <div class="row">
        <br/>
        <div class="col-md-12">
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
        </div>
    </div>
    @php
        $date = new DateTime('now',new DateTimeZone('Asia/Dhaka'));
    @endphp
    <i>Printing Time: {{$date->format('j F Y, g:i a')}}</i>
</div> -->
</body>
</html>



