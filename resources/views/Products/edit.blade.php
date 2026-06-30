<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Product</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body>

<div class="bg-dark text-center text-white py-3">
    <h1 class="h2">Laravel CRUD</h1>
</div>

<div class="container">

    <div class="row">

        <div class="d-flex justify-content-end mt-3">
            <a href="{{ route('products.index') }}"
               class="btn btn-dark">
                Back
            </a>
        </div>

        <div class="card mt-3 p-0">

            <div class="card-header bg-dark text-white">
                <h4>Edit Product</h4>
            </div>

            <div class="card-body">

                <form action="{{ route('products.update', $product->id) }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Name</label>

                        <input type="text"
                               name="name"
                               value="{{ old('name', $product->name) }}"
                               class="form-control @error('name') is-invalid @enderror">

                        @error('name')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image</label>

                        <input type="file"
                               name="image"
                               class="form-control @error('image') is-invalid @enderror">

                        @error('image')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror

                        @if(!empty($product->image))
                            <img src="{{ asset('uploads/products/'.$product->image) }}"
                                 width="120"
                                 class="mt-3 rounded">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">SKU</label>

                        <input type="text"
                               name="sku"
                               value="{{ old('sku', $product->sku) }}"
                               class="form-control @error('sku') is-invalid @enderror">

                        @error('sku')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Price</label>

                        <input type="number"
                               name="price"
                               value="{{ old('price', $product->price) }}"
                               class="form-control @error('price') is-invalid @enderror">

                        @error('price')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>

                        <select name="status" class="form-select">

                            <option value="Active"
                                {{ $product->status == 'Active' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="Inactive"
                                {{ $product->status == 'Inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>
                    </div>

                    <button type="submit" class="btn btn-dark">
                        Update Product
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
