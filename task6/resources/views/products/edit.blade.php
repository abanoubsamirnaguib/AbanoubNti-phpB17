@extends('layouts.main')
@section('title', 'Edit Product')

@section('content')
    @include('partials.message')
    <div class="col-12">
        <form action="{{ route('dashboard.products.update',['id'=>$product->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card ">
                <div class="card-header bg-warning">
                    @yield('title')
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-6">
                            <label for="name_en">Name En</label>
                            <input type="text" name="name_en" id="name_en" class="form-control"
                                value="{{ $product->name }}">
                            @error('name_en')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="name_ar">Name Ar</label>
                            <input type="text" name="name_ar" id="name_ar" class="form-control"
                                value="{{ $product->name}}">
                            @error('name_ar')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row mt-1">
                        <div class="col-4">
                            <label for="code">Code</label>
                            <input type="number" name="code" id="code" class="form-control" value="{{ $product->code}}">
                            @error('code')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control"
                                value="{{ $product->quantity}}">
                            @error('quantity')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label for="price">Price</label>
                            <input type="number" name="price" id="price" class="form-control" value="{{ $product->price}}">
                            @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row mt-1">
                        <div class="col-4">
                            <label for="Status">Status</label>
                            <select name="status" id="Status" class="form-control">
                                @foreach ($statues as $key => $status)
                                    <option @selected($product->status == $key) value="{{ $key }}">{{ $status }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label for="brands">Brands</label>
                            <select name="brand_id" id="brands" class="form-control">
                                <option value="">No Brand</option>
                                @foreach ($brands as $brand)
                                    <option @selected($product->Brand_id == $brand->id) value="{{ $brand->id }}">
                                        {{ $brand->name_en . '-' . $brand->name_ar }}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label for="subcategory_id">Sub Categories</label>
                            <select name="subcategory_id" id="subcategory_id" class="form-control">
                                @foreach ($subcategories as $subcategory)
                                    <option @selected($product->sub_category_id == $subcategory->id) value="{{ $subcategory->id }}">
                                        {{ $subcategory->name_en . '-' . $subcategory->name_ar }}</option>
                                @endforeach
                            </select>
                            @error('subcategory_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row mt-1">
                        <div class="col-6">
                            <label for="desc_en">Details En</label>
                            <textarea name="desc_en" id="desc_en" class="form-control" cols="30" rows="10">{{ $product->desc_en}}</textarea>
                            @error('desc_en')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="desc_ar">Details Ar</label>
                            <textarea name="desc_ar" id="desc_ar" class="form-control" cols="30" rows="10">{{ $product->desc_ar}}</textarea>
                            @error('desc_ar')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row mt-1">
                        <div class="col-4">
                            <label for="image">
                                Upload Product Image
                                <img src="{{ asset('assets/images/products/'.$product->image)}}" id="img" style="cursor: pointer;"
                                    class="w-100" alt="Upload Image">
                            </label>
                            <input type="file" name="image" id="image" class="d-none" onchange="loadFile(event)">
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <button class="btn btn-outline-warning btn-sm rounded" name="redirect" value="index"> Update </button>
                    <button class="btn btn-outline-warning btn-sm rounded" name="redirect" value="back"> Update & Return Back</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('img');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
@endsection
