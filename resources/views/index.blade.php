<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
  </head>
  <body>
        <div class="container my-4">
            <a class="btn btn-primary my-2" href="{{ route('create') }}">add Product</a>
            <a class="btn btn-primary my-2" href="{{ route('show') }}">show!</a>
            <br>
            <form action="{{ route('index') }}" method="GET">
            <div class="form-row">
                <div class="col">
                    <input type="date" class="form-control" name="start_date" placeholder="Start Date">
                </div>
                <div class="col">
                    <input type="date" class="form-control" name="end_date" placeholder="End Date">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Apply Filter</button>
                </div>
            </div>
        </form>
        <br>
            <table class="table">
            <thead>
                <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Warehouse</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Transaction Type</th>
                    <th scope="col">Transaction Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->product->name }}</td>
                    <td>{{ $transaction->supplier->name }}</td>
                    <td>{{ $transaction->warehouse->name }}</td>
                    <td>{{ $transaction->quantity }}</td>
                    <td>{{ $transaction->transaction_type }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('j F Y') }}</td>
                    <td>
                        <a href="{{ route('inventory.edit', $transaction->id) }}" class="btn btn-dark btn-sm"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('inventory.destroy', $transaction->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </body>
</html>