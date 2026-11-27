<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class StockMovementController extends Controller
{
    public function index()
    {
        return StockMovement::with(['product', 'supplier'])->latest()->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => ['required', Rule::in(['in', 'out'])],
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $movement = DB::transaction(function () use ($validated) {

            $product = Product::whereKey($validated['product_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($validated['type'] === 'out' &&
                $product->quantity < $validated['quantity']) {
                abort(422, 'Not enough stock available.');
            }

            if ($validated['type'] === 'in') {
                $product->increment('quantity', $validated['quantity']);
            } else {
                $product->decrement('quantity', $validated['quantity']);
            }

            return StockMovement::create($validated);
        });

        return response()->json([
            'message' => 'Stock movement recorded successfully.',
            'data' => $movement,
        ], 201);
    }
}