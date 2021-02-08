@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex">
            <h2>Lamps</h2>
            <button class="btn-bordered-gray ml-3" onclick="window.location = '{{ route('menu.page') }}'">+ Create</button>
        </div>
    </div>
    <div class="mt-3">
        @include('includes.product')
        <h4 class="mt-5 mb-2 color-base">Selected</h4>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Select</th>
                <th scope="col">#</th>
                <th scope="col">UPC / Ref</th>
                <th scope="col">Image</th>
                <th scope="col">Description</th>
                <th scope="col">Cost</th>
                <th scope="col">*SRP</th>
                <th scope="col">Qty</th>
                <th scope="col">Total</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>

            @if(isset($products))
                @foreach($products as $product)
                    @if($product->selected == 1)
                    <tr>
                        <th>
                            <label class="container-checkbox">
                                <input class="select @if($product->selected == 1) selected @endif" data-id-checkbox="{{ $product->id }}" type="checkbox" @if($product->selected == 1) checked="checked" @endif>
                                <span class="checkmark"></span>
                            </label>
                        </th>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->code }}</td>
                        <td>
                            <img style="width: 60px; height: 60px;"
                                 src="{{ asset('uploads/products/' . $product->id . '/' . $product->image) }}">
                        </td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->cost }}</td>
                        <td>{{ $product->srp }}</td>
                        <td>
                            <div class="number">
                                <span class="minus">-</span>
                                <input class="change_count" type="text" data-product-id="{{ $product->id }}" value="{{ $product->total }}">
                                <span class="plus">+</span>
                            </div>
                        </td>
                        <td>
                            Total?
                        </td>
                        <td>
                            <a style="margin-right: 10px;" href="{{ route('menu.page', $product->id) }}" class="color-base" data-product-id="{{ $product->id }}"> Edit</a>
                            <a href="#" class="color-base delete" data-product-id="{{ $product->id }}"> <i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection
@section('scripts')
    <script>

    </script>
@endsection
