<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }


    public function index()
    {
        $data = $this->productService->all();
        if(Auth::user()->role != 'admin'){
            $data = $data->where('user_id', Auth::id());
        }
        return view('admin.product.index', compact('data'));
    }


    public function create()
    {
        return view('admin.product.create');
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        if($file = $request->file('foto')){
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/berkas/product'), $fileName);
            $data['foto'] = $fileName;
        }
        $this->productService->store($data);
        return redirect()->route('product.index')->with('success','Produk Berhasil ditambahkan');
    }


    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }


    public function edit(Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }


    public function update(Request $request, Product $product)
    {
        $data = $request->all();
        if($file = $request->file('foto')){
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/berkas/product'), $fileName);
            $data['foto'] = $fileName;
        }
        $this->productService->update($data,$product->id);
        return redirect()->route('product.index')->with('success','Produk berhasil diubah');
    }


    public function destroy(Product $product)
    {
        $this->productService->destroy($product->id);
        return redirect()->route('product.index')->with('success','Produk berhasil dihapus');
    }
}
