@extends('layouts.app')

@section('content')
<div class="fade active show" id="contentBlock" role="tabpanel" aria-labelledby="v-pills-SUMMARY-tab">
        <div>
            <div>
                <h2 class="generic-title">Summary</h2>
            </div>
            @foreach($categories as $category)
                @if(count($category->products))
                    <h3>{{ $category->category_title }}</h3>
                    @include('includes.product', ['products' => $category->products])
                @endif
            @endforeach


        </div>

        <div class="shipping-container">
            <form>
                <div class="form-group col-lg-4 pl-0">
                    <label for="saleRap">Sales Rep</label>
                    <input type="text" class="form-control" id="saleRap" aria-describedby="saleRap" placeholder="Ann Brown">
                </div>
                <h2 class="mb-5">Client information</h2>

                <div class="row m-0">
                    <div class="col-lg-4 pl-0 pr-0">
                        <div class="form-group sml-input">
                            <label for="retailerName">Retailer name</label>
                            <input type="text" class="form-control" id="retailerName" placeholder="John Peter">
                        </div>
                        <div class="form-group sml-input">
                            <label for="retailerEmail">Email</label>
                            <input type="email" class="form-control" id="retailerEmail" placeholder="JohnPeter@gmail.com">
                        </div>
                    </div>
                    <div class="col-lg-4 pl-0 pr-0">
                        <div class="form-group">
                            <label for="shippingAddress">shipping address</label>
                            <div class="d-flex">
                                <div class="p-0 col-lg-7">
                                    <input type="text" class="form-control" id="shippingAddress" placeholder="22, Street dr Toronto, Ontario">
                                </div>
                                <div class="col-lg-5 pr-0">
                                    <input type="text" class="form-control" id="shippingAddress2" placeholder="L4P 5W7">
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="retailerName">Phone</label>
                            <input type="number" class="form-control" id="retailerName" placeholder="+91 9876543210">
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-3  payment-container">
                        <div class="d-flex justify-content-between">
                            <b>
                                Total:
                            </b>
                            <p class="totalGlobal">
                                $00
                            </p>
                        </div>
                    </div>
                </div>


            </form></div>
        <div class="d-flex flex-row-reverse">
            <button onclick="printSummary();" class="btn-baseDark">Print</button>
        </div>

    </div>
@endsection
@section('scripts')
    <script>

        function printSummary(){
            $('.left-menu').hide();
            $('.dashboard-content').css('margin-left', '0');
            print();
            $('.left-menu').show();
            $('.dashboard-content').css('margin-left', '270px');
        }

        function PrintElem(elem)
        {
            // var mywindow = window.open('', 'PRINT', 'height=400,width=600');
            //
            // mywindow.document.write('<html><head><title>' + document.title  + '</title>');
            // mywindow.document.write('</head><body >');
            // mywindow.document.write('<h1>' + document.title  + '</h1>');
            // mywindow.document.write(document.getElementById(elem).innerHTML);
            // mywindow.document.write('</body></html>');
            //
            // mywindow.document.close(); // necessary for IE >= 10
            // mywindow.focus(); // necessary for IE >= 10*/

            window.print();
            // mywindow.close();

            return true;
        }
    </script>
@endsection
