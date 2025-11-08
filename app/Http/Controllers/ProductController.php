<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Category = Category::all();
        return view('admin.products.create', ['Category' => $Category]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)

    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'required|image|mimes:png,jpg,svg',
            'about' => 'required|string|max:255',
            'price' => 'required|int',
            'category_id' => 'required|exists:categories,id'


        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('photo')) {
                $iconPath = $request->file('photo')->store('product_photo', 'public');
                $validated['photo'] = $iconPath;
            }

            $validated['slug'] = Str::slug($request->name);

            Product::create($validated);

            DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            throw ValidationException::withMessages([
                'system_error' => ['System Error! ' . $e->getMessage()],
            ]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $Categories = Category::all();
        return view('admin.products.edit', ['product' => $product, 'Categories' => $Categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'sometimes|image|mimes:png,jpg,svg',
            'about' => 'required|string|max:255',
            'price' => 'required|int',
            'category_id' => 'sometimes|exists:categories,id'


        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('photo')) {
                $iconPath = $request->file('photo')->store('product_photo', 'public');
                $validated['photo'] = $iconPath;
            }

            $validated['slug'] = Str::slug($request->name);

            $product->update($validated);

            DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            throw ValidationException::withMessages([
                'system_error' => ['System Error! ' . $e->getMessage()],
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages([
                'system_error' => ['System Error! ' . $e->getMessage()],
            ]);
        }
    }
}
