<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ChartComponent extends Component
{
    public function render()
    {

        $productos = Product::select('*')->count();
        $categories = Category::select('*')->count();

        $var = [
            'productos' => $productos,
            'categories' => $categories
        ];


        return view('livewire.graficos.chart-component', ['var' => $var])->extends('layouts.theme.template')->section('content');
    }
}
