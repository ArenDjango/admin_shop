@extends('layouts.app')

@section('content')
    <div>
        <h2 class="generic-title">{{ isset($product) ? $product->title : 'Add new product' }}</h2>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" enctype="multipart/form-data" style="max-width: 100%; margin-left: 10px;">
        @csrf
        @if(isset($product))
            <input type="hidden" name="product_id" value="{{ $product->id }}">
        @endif

        <div class="row create-container">
            <div class="form-group">

                @if(isset($product))
                    <label>Category</label>
                    <select class="form-control" name="category_id">
                        @foreach($categories as $category)
                            <option class="form-control" @if($category->id == $product->category_id) selected @endif value="{{ $category->id }}">{{ $category->category_title }}</option>
                        @endforeach
                    </select>
                    <br>
                    <label>User</label>
                    <select class="form-control" name="user_id">
                        @foreach($users as $user)
                            <option class="form-control" @if($user->id == $product->user_id) selected @endif value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                @else
                    <label>Category</label>
                    <select class="form-control" name="category_id">
                        <option selected hidden value="null">Select category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_title }}</option>
                        @endforeach
                    </select>
                    <br>
                    @if(auth()->user()->role == 'admin')
                        <label>User</label>
                        <select class="form-control" name="user_id">
                            @foreach($users as $user)
                                <option @if($user->id == auth()->id()) selected @endif value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    @endif
                @endif
            </div>
        </div>
        <div class="d-flex lamp-container row">
            <div class="avatar-upload lamp-avatar" style="height: 350px;">
                <div class="avatar-edit">
                    <input type="file" id="imageUpload" name="image" accept=".png, .jpg, .jpeg">
                    <label for="imageUpload">Upload Photo</label>
                </div>
                <div class="avatar-preview">
                    <div id="imagePreview"
                         style="background-image: url('{{ isset($product) ? asset('uploads/products/' . $product->id . '/' . $product->image)  : asset('img/upload-icon.png') }}')">
                    </div>
                </div>
            </div>

            <div class="lamp-form ">

                    <div class="form-group">
                        <label>Size</label>
                        <input class="form-control code" required value="{{ isset($product) ? $product->size : '' }}" name="size" type="text">
                        <br>
                        <label>UPC / Ref</label>
                        <input class="form-control code" required value="{{ isset($product) ? $product->code : '' }}" name="code" type="text">
                        <br>
                        <label>#</label>
                        <input required class="form-control hash" value="{{ isset($product) ? $product->hash : '' }}" name="hash" type="text">
                    </div>


                <div class="form-group">
                    <label>Qty</label>
                    <input class="form-control" required value="{{ isset($product) ? $product->qty : '1' }}" name="qty" type="number">
                </div>

                    <div class="form-group">
                        <label>*SRP</label>
                        <input class="form-control" required value="{{ isset($product) ? $product->srp : '' }}"
                               name="srp" type="text">
                    </div>

                    <div class="form-group" style="width: 100%">
                        <label>Description</label>
                        <input name="description" required class="form-control" value="{{ isset($product) ? $product->description : '' }}" placeholder="Write here some description about the product" type="text">
                    </div>

                    <div class="form-group">
                        <label>Cost</label>
                        <input required class="form-control" name="cost" value="{{ isset($product) ? $product->cost : '' }}" type="text">
                    </div>
                <div class="d-flex flex-row-reverse">
                    <button class="btn-baseDark">Save</button>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        $('.code').on('input', function(){
            console.log('dsf');
            let val = $(this).val().replace(/\s/g, '');
            let last_char = val.substr(val.length - 1);
            let hash = val.substr(val.length - 5).slice(0, -1);
           $('.hash').val(hash);
        });
    </script>
@endsection
