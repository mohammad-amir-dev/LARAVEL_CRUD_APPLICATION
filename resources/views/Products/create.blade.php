<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Product</title>

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
                <h4>Create Product</h4>
            </div>

            <div class="card-body">

                <form action="{{ route('products.store') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Name</label>

                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Enter Product Name">

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
                    </div>

                    <div class="mb-3">
                        <label class="form-label">SKU</label>

                        <input type="text"
                               name="sku"
                               value="{{ old('sku') }}"
                               class="form-control @error('sku') is-invalid @enderror"
                               placeholder="Enter SKU">

                        @error('sku')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Price</label>

                        <input type="number"
                               name="price"
                               value="{{ old('price') }}"
                               class="form-control @error('price') is-invalid @enderror"
                               placeholder="Enter Price">

                        @error('price')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>

                        <select name="status"
                                class="form-select @error('status') is-invalid @enderror">

                            <option value="">Select Status</option>

                            <option value="Active"
                                {{ old('status') == 'Active' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="Inactive"
                                {{ old('status') == 'Inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                        @error('status')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-dark">
                        Create Product
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
