<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Inv; 
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    
    public function index(Request $request)
    {
        $transactions = Inv::with(['product', 'supplier', 'warehouse']);

        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            
            $transactions->whereBetween('transaction_date', [$startDate, $endDate]);
        }

        $transactions = $transactions->get();
        
        return view('index', compact('transactions'));

    }

    public function create()
    {
        $products = Product::pluck('name', 'id');
        $suppliers = Supplier::pluck('name', 'id');
        $warehouses = Warehouse::pluck('name', 'id');
        
        return view('create', compact('products', 'suppliers', 'warehouses'));
    
    }

    public function store(Request $request)
    {
        $request->validate([
            'product' => 'required|exists:products,id',
            'supplier' => 'required|exists:suppliers,id',
            'warehouse' => 'required|exists:warehouses,id',
            'quantity' => 'required|integer|min:1',
            'transactionType' => 'required|in:in,out',
            'transactionDate' => 'required|date',
        ]);

        Inv::create([
            'product_id' => $request->input('product'),
            'supplier_id' => $request->input('supplier'),
            'warehouse_id' => $request->input('warehouse'),
            'quantity' => $request->input('quantity'),
            'transaction_type' => $request->input('transactionType'),
            'transaction_date' => $request->input('transactionDate'),
        ]);

        return redirect()->route('index')->with('success', 'Inventory transaction created successfully.');
    }

    public function edit($id)
    {
        $transaction = Inv::findOrFail($id);
        $products = Product::pluck('name', 'id');
        $suppliers = Supplier::pluck('name', 'id');
        $warehouses = Warehouse::pluck('name', 'id');
        return view('edit', compact('transaction', 'products', 'suppliers', 'warehouses'));

    }

    public function show(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $transactions = Inv::with('product');

        if ($startDate && $endDate) {
            $transactions->whereBetween('transaction_date', [$startDate, $endDate]);
        }

        $aggregatedTransactions = $transactions->join('products', 'inventory_transactions.product_id', '=', 'products.id')
            ->groupBy(['inventory_transactions.product_id', 'inventory_transactions.supplier_id', 'inventory_transactions.warehouse_id'])
            ->selectRaw('inventory_transactions.product_id, inventory_transactions.supplier_id, inventory_transactions.warehouse_id, SUM(inventory_transactions.quantity) as total_quantity, SUM(inventory_transactions.quantity * products.price) as total_value')
            ->get();

        return view('show', compact('aggregatedTransactions'));
    }

    public function update(Request $request, $id)
    {  
        $request->validate([
            'product' => 'required|exists:products,id',
            'supplier' => 'required|exists:suppliers,id',
            'warehouse' => 'required|exists:warehouses,id',
            'quantity' => 'required|integer|min:1',
            'transactionType' => 'required|in:in,out',
            'transactionDate' => 'required|date',
        ]);

        $transaction = Inv::findOrFail($id);

        $transaction->update([
            'product_id' => $request->input('product'),
            'supplier_id' => $request->input('supplier'),
            'warehouse_id' => $request->input('warehouse'),
            'quantity' => $request->input('quantity'),
            'transaction_type' => $request->input('transactionType'),
            'transaction_date' => $request->input('transactionDate'),
        ]);

        return redirect()->route('index')->with('success', 'Inventory transaction updated successfully.');
    }

    public function destroy($id)
    {

        $transaction = Inv::findOrFail($id);
        $transaction->delete();
        return redirect()->route('index')->with('success', 'Inventory transaction deleted successfully.');
    
    }
}
