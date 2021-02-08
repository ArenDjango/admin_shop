@extends('layouts.app')

@section('content')
    <div>
        <h2>{{ isset($product) ? $product->title : 'Add new product' }}</h2>
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

        <div class="row">
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
                        <label>UPC / Ref</label>
                        <input class="form-control" value="{{ isset($product) ? $product->code : '' }}" name="code" type="text">
                    </div>
                    <div class="form-group">
                        <label>Total</label>
                        <input class="form-control" value="{{ isset($product) ? $product->total : '' }}" name="total" type="number">
                    </div>
                    <div class="form-group">
                        <label>*SRP</label>
                        <input class="form-control" value="{{ isset($product) ? $product->srp : '' }}" name="srp" type="number">
                    </div>


                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control" value="{{ isset($product) ? $product->title : '' }}" name="title" placeholder="Title" />
                    </div>


                    <div class="form-group" style="width: 100%">
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Write here some description about the product">
                            {{ isset($product) ? $product->description : '' }}
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label>Cost</label>
                        <input required class="form-control" name="cost" value="{{ isset($product) ? $product->cost : '' }}" type="number">
                    </div>
                <div class="d-flex flex-row-reverse">
                    <button class="btn-baseDark">Save</button>
                </div>
            </div>
        </div>
    </form>
@endsection
