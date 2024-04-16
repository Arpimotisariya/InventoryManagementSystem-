<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Inventory Transaction</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-4">
        <h2>Edit Inventory Transaction</h2>
        <form action="{{ route('inventory.update', $transaction->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="product">Product</label>
                <select class="form-control" name="product">
                    @foreach($products as $productId => $productName)
                        <option value="{{ $productId }}" {{ $transaction->product_id == $productId ? 'selected' : '' }}>{{ $productName }}</option>
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
                        <option value="{{ $supplierId }}" {{ $transaction->supplier_id == $supplierId ? 'selected' : '' }}>{{ $supplierName }}</option>
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
                        <option value="{{ $warehouseId }}" {{ $transaction->warehouse_id == $warehouseId ? 'selected' : '' }}>{{ $warehouseName }}</option>
                    @endforeach
                </select>
                @error('warehouse')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" name="quantity" value="{{ $transaction->quantity }}">
                @error('quantity')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="transactionType">Transaction Type</label>
                <select class="form-control" name="transactionType">
                    <option value="in" {{ $transaction->transaction_type == 'in' ? 'selected' : '' }}>In</option>
                    <option value="out" {{ $transaction->transaction_type == 'out' ? 'selected' : '' }}>Out</option>
                </select>
                @error('transactionType')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="transactionDate">Transaction Date</label>
                <input type="date" class="form-control" name="transactionDate" value="{{ $transaction->transaction_date }}">
                @error('transactionDate')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
