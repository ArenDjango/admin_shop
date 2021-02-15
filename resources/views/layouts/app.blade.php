<!doctype html>

<html>

<head>
    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no,minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
          crossorigin="anonymous"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/secondary/owl-carousel-min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/secondary/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css/main.css') }}">

</head>

<body>
<div id="app">
    @include('includes.header')
    <main>
        <div class="d-flex">
            @if(Auth::check())
            @include('includes.sidebar')
            @endif
            <div class="dashboard-content">
                @yield('content')
            </div>
        </div>
    </main>
</div>


<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>

@section('scripts')
@show
<script>
    $('.burger').on('click', function(){
        console.log(this);
        $(this).parent().toggleClass('open-burger');
    });

    $('.delete').each(function(){
       $(this).on('click', function(){
           let $this = this;
           $.ajax({
               'url': '{{ route('menu.delete') }}',
               'method': 'POST',
               'data': {'_token': '{{ csrf_token() }}', 'product_id': $($this).attr('data-product-id')},
               'success': function(){
                   $($this).parent().parent().remove();
               },
               'error': function(error){console.log(error)}
           });
       }) ;
    });

    $('.change_count').each(function(){
        $(this).on('input change', function(){
            changeTotal(this);
        });
        $(this).prev().on('click', function(){
            changeTotal(this);
        })
        $(this).next().on('click', function(){
            changeTotal(this);
        })

        function changeTotal($this){
            console.log($($this).val());
            $.ajax({
                'url': '{{ route('menu.change_count') }}',
                'method': 'POST',
                'data': {'_token': '{{ csrf_token() }}', 'product_id': $($this).attr('data-product-id'), 'qty': $($this).val()},
                'success': function(){total();},
                'error': function(error){console.log(error)}
            });
        }
    });

    $(document).on('change', $('.select'), function(el){
        let $this = el.target;
        $.ajax({
            'url': '{{ route('menu.select') }}',
            'method': 'POST',
            data: {_token: '{{ csrf_token() }}', 'id': $($this).attr('data-id-checkbox')},
            success: function(data){
                console.log(data);
                @if(Route::currentRouteName() == 'menu.category')
                    window.location = window.location.href;
                @endif
            }
        });

    });

    total();
    function total(){
        let totalGlobal = 0;
        $('.product-item').each(function(){
            let cost = parseInt($(this).find('.cost').text());
            let quality = parseInt($(this).find('.change_count').val());
            let total = cost * quality;
            console.log('total' + total);
            totalGlobal+= total;
            $(this).find('.total').text('$' + total);
        });
        $('.totalGlobal').text('$ ' + totalGlobal)
    }

</script>
</body>
</html>
