<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use App\Repositories\CartProductService;
use Illuminate\Http\Request;

class CartProductController extends Controller
{
    private $cartproductService;

    public function __construct(CartProductService $cartproductService)
    {
        $this->cartproductService = $cartproductService;
    }


    public function index()
    {
        $data = $this->cartproductService->all();
        return view('admin.cartproduct.index', compact('data'));
    }


    public function create()
    {
        return view('admin.cartproduct.create');
    }


    public function store(Request $request)
    {
        $this->cartproductService->store($request->all());
        return redirect()->route('cartproduct.index')->with('success','CartProduct has success created');
    }


    public function show(CartProduct $cartproduct)
    {
        return view('admin.cartproduct.show', compact('cartproduct'));
    }


    public function edit(CartProduct $cartproduct)
    {
        return view('admin.cartproduct.edit', compact('cartproduct'));
    }


    public function update(Request $request, CartProduct $cartproduct)
    {
        $this->cartproductService->update($request->all(),$cartproduct->id);
        return redirect()->route('cartproduct.index')->with('success','CartProduct has success updated');
    }


    public function destroy(CartProduct $cartproduct)
    {
        $this->cartproductService->destroy($cartproduct->id);
        return redirect()->route('cartproduct.index')->with('success','CartProduct has success deleted');
    }
}