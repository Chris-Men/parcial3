<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProductComponent extends Component
{

    use WithPagination;
    public $search, $pageTitle, $componentName, $selected_id, $name, $descripcion, $price, $stock, $categoria_id;
    private $pagination = 5;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->pageTitle = 'LISTADO';
        $this->componentName = 'PRODUCTOS';
    }

    public function render()
    {


        if (strlen($this->search) > 0) {
            $products = Product::join('categories as c', 'c.id', 'products.categoria_id')
                ->select('products.*', 'c.name as namecategoria')
                ->where('products.name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('products.descripcion', 'LIKE', '%' . $this->search . '%')
                ->orWhere('products.price', 'LIKE', '%' . $this->search . '%')
                ->orWhere('products.stock', 'LIKE', '%' . $this->search . '%')
                ->orWhere('c.name', 'LIKE', '%' . $this->search . '%')
                ->orderBy('products.id', 'DESC')
                ->paginate($this->pagination);
        } else {
            $products = Product::join('categories as c', 'c.id', 'products.categoria_id')
                ->select('products.*', 'c.name as namecategoria')
                ->orderBy('products.id', 'DESC')
                ->paginate($this->pagination);
        }


        return view(
            'livewire.productos.product-component',
            [
                'products' => $products,
                'categories' => Category::orderBy('id', 'DESC')->get()
            ]
        )->extends('layouts.theme.template')->section('content');
    }

    public function resetUI()
    {
        $this->selected_id = 0;
        $this->name = '';
        $this->descripcion = '';
        $this->price = '';
        $this->stock = '';
        $this->categoria_id = '';
        $this->resetPage();
        $this->resetValidation();
    }

    public function Store()
    {
        $rules = [
            'name' => 'required',
            'descripcion' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'categoria_id' => 'required'
        ];

        $messages = [
            'name.required' => 'El campo del nombre del producto es requerido',
            'descripcion.required' => 'La descripcion del producto es requerida',
            'price.required' => 'El precio del producto es requerido',
            'price.numeric' => 'Solo se aceptan numeros',
            'stock.required' => 'El stock del producto es requerido',
            'stock.numeric' => 'Solo se aceptan numeros',
            'categoria_id.required' => 'Tienes que seleccionar una categoria'
        ];

        $this->validate($rules, $messages);

        $productos = Product::create([
            'name' => $this->name,
            'descripcion' => $this->descripcion,
            'price' => $this->price,
            'stock' => $this->stock,
            'categoria_id' => $this->categoria_id
        ]);

        $productos->save();

        $this->resetUI();
        $this->dispatch('add-producto');
    }

    public function Edit($id)
    {
        $productos = Product::find($id, ['id', 'name', 'descripcion', 'price', 'stock', 'categoria_id']);
        $this->selected_id = $productos->id;
        $this->name = $productos->name;
        $this->descripcion = $productos->descripcion;
        $this->price = $productos->price;
        $this->stock = $productos->stock;
        $this->categoria_id = $productos->categoria_id;

        $this->dispatch('show-modal');
    }

    public function Update()
    {
        $rules = [
            'name' => 'required',
            'descripcion' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'categoria_id' => 'required'
        ];

        $messages = [
            'name.required' => 'El campo del nombre del producto es requerido',
            'descripcion.required' => 'La descripcion del producto es requerida',
            'price.required' => 'El precio del producto es requerido',
            'price.numeric' => 'Solo se aceptan numeros',
            'stock.required' => 'El stock del producto es requerido',
            'stock.numeric' => 'Solo se aceptan numeros',
            'categoria_id.required' => 'Tienes que seleccionar una categoria'
        ];

        $this->validate($rules, $messages);

        $productos = Product::find($this->selected_id);

        $productos->update([
            'name' => $this->name,
            'descripcion' => $this->descripcion,
            'price' => $this->price,
            'stock' => $this->stock,
            'categoria_id' => $this->categoria_id
        ]);

        $this->resetUI();
        $this->dispatch('update-producto');
    }


    public function Destroy(Product $producto)
    {
        $producto->delete();
        $this->resetUI();
        $this->dispatch('producto-delete');
    }

    public function GenerarReporteUnico($id)
    {
        $productos = Product::find($id, ['id', 'name', 'descripcion', 'price', 'stock', 'categoria_id']);
        $this->selected_id = $productos->id;
        $this->name = $productos->name;
        $this->descripcion = $productos->descripcion;
        $this->price = $productos->price;
        $this->stock = $productos->stock;
        $this->categoria_id = $productos->categoria_id;

        $pdf = PDF::loadView('pdf.ReporteUniqueProduct', ['productos' => $productos]);
        return $pdf->download('Reporteuniqueproductos.pdf');
    }

    public function GenerarQR($id)
    {
        $productos = Product::find($id, ['id', 'name', 'descripcion', 'price', 'stock', 'categoria_id']);
        $this->selected_id = $productos->id;
        $this->name = $productos->name;
        $this->descripcion = $productos->descripcion;
        $this->price = $productos->price;
        $this->stock = $productos->stock;
        $this->categoria_id = $productos->categoria_id;
    }
    
}
