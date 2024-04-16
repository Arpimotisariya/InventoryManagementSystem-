<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Transaction Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-3">
        <h2>Inventory Transaction Form</h2>
        <form action="{{ route('store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="product">Product</label>
                <select class="form-control" name="product">
                    @foreach($products as $productId => $productName)
                        <option value="{{ $productId }}">{{ $productName }}</option>
                    @endforeach
                </select>
                @error('product')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="supplier">Supplier</label>
                <select class="form-control" name="supplier">
                    @foreach($suppliers as $supplierId => $supplierName)
                        <option value="{{ $supplierId }}">{{ $supplierName }}</option>
                    @endforeach
                </select>
                @error('supplier')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="warehouse">Warehouse</label>
                <select class="form-control" name="warehouse">
                    @foreach($warehouses as $warehouseId => $warehouseName)
                        <option value="{{ $warehouseId }}">{{ $warehouseName }}</option>
                    @endforeach
                </select>
                @error('warehouse')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" name="quantity" placeholder="Enter quantity">
                @error('quantity')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="transactionType">Transaction Type</label>
                <select class="form-control" name="transactionType">
                    <option value="in">In</option>
                    <option value="out">Out</option>
                </select>
                @error('transactionType')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="transactionDate">Transaction Date</label>
                <input type="date" class="form-control" name="transactionDate">
                @error('transactionDate')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
