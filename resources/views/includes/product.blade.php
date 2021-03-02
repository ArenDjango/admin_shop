




{{--<div class="table">--}}
{{--    <div class="thead-dark">--}}
{{--        <div class="row d-flex align-items-center">--}}
{{--            <div class="col"></div>--}}
{{--            <div class="col col-2">UPC / Ref</div>--}}
{{--            <div class="col">Item #</div>--}}
{{--            <div class="col">Image</div>--}}
{{--            <div class="col col-2">Description</div>--}}
{{--            <div class="col">Cost</div>--}}
{{--            <div class="col">*SRP</div>--}}
{{--            <div class="col">Qty</div>--}}
{{--            <div class="col">Total</div>--}}
{{--            <div class="col"></div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="tbody products">--}}
{{--        @if(isset($products))--}}
{{--            @foreach($products as $product)--}}
{{--                <div class="row mx-0 my-2 align-items-center" data-id="{{ $product->id }}">--}}
{{--                    <div class="col">--}}
{{--                        <label class="container-checkbox">--}}
{{--                            <input class="select @if($product->selected == 1) selected @endif" data-id-checkbox="{{ $product->id }}" type="checkbox" @if($product->selected == 1) checked="checked" @endif>--}}
{{--                            <span class="checkmark"></span>--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                    <div class="col col-2">{{ $product->code }}</div>--}}
{{--                    <div class="col">{{ $product->id }}</div>--}}
{{--                    <div class="col col-2 d-flex text-left">{{ $product->title }} <img style="width: 100px; height: 100px;"--}}
{{--                                                                                       src="{{ asset('uploads/products/' . $product->image) }}"></div>--}}
{{--                    <div class="col">${{ $product->cost }}</div>--}}
{{--                    <div class="col">{{ $product->srp }}</div>--}}
{{--                    <div class="col">--}}
{{--                        <div class="number">--}}
{{--                            <span class="minus">-</span>--}}
{{--                            <input class="change_count" type="text" data-product-id="{{ $product->id }}" value="{{ $product->total }}">--}}
{{--                            <span class="plus">+</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col">$25</div>--}}
{{--                    <div class="col">--}}
{{--                        <a href="{{ route('menu.page', $product->id) }}" class="color-base" data-product-id="{{ $product->id }}"> Edit</a>--}}
{{--                        <a href="#" class="color-base delete" data-product-id="{{ $product->id }}"> <i class="fas fa-trash"></i></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        @endif--}}

{{--    </div>--}}
{{--</div>--}}



<div class="tableDiv" style="max-width: 100%; width: 100%; overflow-x: auto !important;">
    <table class="table">
        <thead>
        <tr class="tr">
            <th scope="col">Select</th>
            <th scope="col">#</th>
            <th scope="col">UPC / Ref</th>
            <th scope="col">Image</th>
            <th scope="col">Description</th>
            <th scope="col">Cost</th>
            <th scope="col">*SRP</th>
            <th scope="col">Qty</th>
            <th scope="col">Total</th>
            <th scope="col">Size</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

        @if(isset($products))
            @foreach($products as $product)
                <tr class="product-item">
                    <th>
                        <label class="container-checkbox">
                            <input class="select @if($product->selected == 1) selected @endif" data-id-checkbox="{{ $product->id }}" type="checkbox" @if($product->selected == 1) checked="checked" @endif>
                            <span class="checkmark"></span>
                        </label>
                    </th>
                    <td>{{ $product->hash }}</td>
                    <td><p>{{ substr(str_replace(' ', '', $product->code), 0, 6) }} <strong>{{ $product->hash }} </strong>{{ substr($product->code, -1) }}</p></td>
                    <td>
                        <img style="max-width: 60px; max-height: 60px; display: block; "
                             src="{{ asset('uploads/products/' . $product->id . '/' . $product->image) }}">
                    </td>
                    <td>{{ $product->description }}</td>
                    <td class="cost">{{ $product->cost }}</td>
                    <td>${{ $product->srp }}</td>
                    <td>
                        <div class="number">
                            <span class="minus">-</span>
                            <input class="change_count" type="text" data-product-id="{{ $product->id }}" value="{{ $product->qty }}">
                            <span class="plus">+</span>
                        </div>
                    </td>
                    <td class="total">
                        0
                    </td>
                    <td>
                        {{ $product->size }}
                    </td>
                    <td>
                        <a style="margin-right: 10px;" href="{{ route('menu.page', $product->id) }}" class="color-base" data-product-id="{{ $product->id }}"> Edit</a>
                        <a href="#" class="color-base delete" data-product-id="{{ $product->id }}"> <i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
