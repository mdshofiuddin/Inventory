<!DOCTYPE html>
<html>
<head>
    <title>Stock Report Pdf</title>
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
            <table width="100%">
                <tbody>
                <tr>
                    <td width="40%"></td>
                    <td><u><strong>Stock Report</strong></u></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-12">
            <table width="100%" class="table" style="font-size: 12px" border="1">
                <thead>
                <tr>
                    <th class="text-center">SL.</th>
                    <th class="text-center">Supplier Name</th>
                    <th class="text-center">Category</th>
                    <th class="text-center">In.qty</th>
                    <th class="text-center">Out.qty</th>
                    <th class="text-center">Product Name</th>
                    <th class="text-center">Stock</th>
                    <th class="text-center">Unit</th>
                </tr>
                </thead>
                <tbody class="text-center">
                @foreach($allData as $key => $product)
                    @php
                        $buying_total = \App\Model\Purchase::where('category_id',$product->category_id)->where('product_id',$product->id)->where('status','1')->sum('buying_qty');
                        $selling_total = \App\Model\InvoiceDetail::where('category_id',$product->category_id)->where('product_id',$product->id)->where('status','1')->sum('selling_qty');
                    @endphp
                    <tr>
                        <td style="padding: 1px;" class="text-center">{{$key +1}}</td>
                        <td style="padding: 1px;" class="text-center">{{$product['supplier']['name']}}</td>
                        <td style="padding: 1px;" class="text-center">{{$product['category']['name']}}</td>
                        <td style="padding: 1px;" class="text-center">{{$buying_total}} </td>
                        <td style="padding: 1px;" class="text-center">{{$selling_total}}</td>
                        <td style="padding: 1px;" class="text-center">{{$product->name}}</td>
                        <td style="padding: 1px;" class="text-center">{{$product->quantity}}</td>
                        <td style="padding: 1px;" class="text-center">{{$product['unit']['name']}}</td>



                    </tr>
                @endforeach
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


