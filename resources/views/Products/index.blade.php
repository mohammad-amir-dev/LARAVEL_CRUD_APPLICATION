
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel CRUD Project</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body>

<div class="bg-dark text-center text-white py-3">
    <h1 class="h2">Laravel CRUD</h1>
</div>

<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('products.create') }}"
           class="btn btn-dark">
            Create Product
        </a>
    </div>

    <div class="card">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Products</h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>SKU</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th width="180">Action</th>
                </tr>
                </thead>

                <tbody>

                @forelse($products as $product)

                    <tr>

                        <td>{{ $product->id }}</td>

                        <td>
                            @if(!empty($product->image))
                                <img src="{{ asset('uploads/products/'.$product->image) }}"
                                     width="60"
                                     class="rounded">
                            @else
                                <img src="https://placehold.co/60x60"
                                     width="60"
                                     class="rounded">
                            @endif
                        </td>

                        <td>{{ $product->name }}</td>

                        <td>{{ $product->sku }}</td>

                        <td>₹{{ $product->price }}</td>

                        <td>
                            @if($product->status == 'Active')
                                <span class="badge bg-success">
                                    Active
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    Inactive
                                </span>
                            @endif
                        </td>

                        <td>

                            <a href="{{ route('products.edit',$product->id) }}"
                               class="btn btn-primary btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('products.destroy',$product->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="text-center">
                            No Products Found
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
