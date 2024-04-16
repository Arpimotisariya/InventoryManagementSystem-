<!DOCTYPE html>
<html lang="en">
<head>
    <title>Inventory</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Inventory</h1>
        <form method="GET" action="{{ route('show') }}" class="mb-4">
            <div class="form-row">
                <div class="col">
                    <input type="date" name="start_date" class="form-control" placeholder="Start Date">
                </div>
                <div class="col">
                    <input type="date" name="end_date" class="form-control" placeholder="End Date">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total Value</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach($aggregatedTransactions as $transaction)
                    @php
                        $total += $transaction->total_value;
                    @endphp
                    <tr style="{{ $transaction->total_quantity < 10 ? 'background-color: red;' : '' }}">
                        <td>{{ $transaction->product->name }}</td>
                        <td>{{ $transaction->total_quantity }}</td>
                        <td>{{ $transaction->total_value }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2" class="text-right"><strong>Total:</strong></td>
                    <td><strong>{{ $total }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
