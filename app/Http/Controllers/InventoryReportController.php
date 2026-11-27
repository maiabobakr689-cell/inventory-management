<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockMovement;

class InventoryReportController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();

        return response()->json([
            'total_products' => Product::count(),

            'total_quantity' => Product::sum('quantity'),

            'low_stock_products' => Product::with('category')
                ->where('quantity', '<=', 5)
                ->get(),

            'products' => $products,
        ]);
    }

    public function supplierPurchases()
{
    $movements = StockMovement::with(['supplier', 'product'])
        ->where('type', 'in')
        ->latest()
        ->get();

    return response()->json([
        'total_supply_operations' => $movements->count(),

        'total_supplied_quantity' => $movements->sum('quantity'),

        'movements' => $movements,
    ]);
}

public function lowStockAlerts(Request $request)
{
    $validated = $request->validate([
        'limit' => 'sometimes|integer|min:0',
    ]);

    $limit = $validated['limit'] ?? 5;

    $products = Product::with('category')
        ->where('quantity', '<=', $limit)
        ->orderBy('quantity', 'asc')
        ->get();

    return response()->json([
        'message' => 'Low stock products retrieved successfully.',
        'alert_limit' => $limit,
        'total_low_stock_products' => $products->count(),
        'products' => $products,
    ]);
}
}