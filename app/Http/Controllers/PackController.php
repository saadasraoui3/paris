<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PackController extends Controller
{
    public function index() {
        // Les packs sont affichés dans la page products
        return redirect()->route('admin.products.index');
    }

    public function create() {
        return view('admin.packs.create', [
            'products' => Product::orderBy('name')->get()
        ]);
    }

    public function store(Request $request) {
        $validated = $this->validatePack($request);

        $pack = Pack::create([
            'name' => $validated['name'],
            'slug' => $this->uniqueSlug($validated['name']),
            'price' => $validated['price'],
        ]);

        $pack->products()->sync($this->productsWithQuantity($validated));

        return redirect()->route('admin.products.index')
            ->with('success', 'Pack created successfully');
    }

    public function edit(Pack $pack) {
        return view('admin.packs.edit', [
            'pack' => $pack->load('products'),
            'products' => Product::orderBy('name')->get()
        ]);
    }

    public function update(Request $request, Pack $pack) {
        $validated = $this->validatePack($request);

        $pack->update([
            'name' => $validated['name'],
            'slug' => $pack->name === $validated['name'] ? $pack->slug : $this->uniqueSlug($validated['name'], $pack->id),
            'price' => $validated['price'],
        ]);

        $pack->products()->sync($this->productsWithQuantity($validated));

        return redirect()->route('admin.products.index')
            ->with('success', 'Pack updated successfully');
    }

    public function destroy(Pack $pack) {
        $pack->delete();
        return back();
    }

    private function validatePack(Request $request) {
        return $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'products' => 'required|array|min:1',
            'products.*' => 'exists:products,id',
            'quantities' => 'nullable|array',
            'quantities.*' => 'nullable|integer|min:1',
        ]);
    }

    // [product_id => ['quantity' => n]] pour sync()
    private function productsWithQuantity(array $validated) {
        $quantities = $validated['quantities'] ?? [];

        return collect($validated['products'])->mapWithKeys(fn ($id) => [
            $id => ['quantity' => max(1, (int) ($quantities[$id] ?? 1))]
        ])->all();
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null) {
        $base = Str::slug($name) ?: 'pack';
        $slug = $base;
        $i = 2;

        while (Pack::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }
}
