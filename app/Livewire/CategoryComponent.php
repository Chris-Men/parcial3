<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use PDF;

class CategoryComponent extends Component
{
    use WithPagination;
    public $pageTitle, $selected_id, $componentName, $search;
    public $name, $description;
    private $pagination = 5;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Categorias';
    }

    public function render()
    {

        if (strlen($this->search) > 0) {
            $categories = Category::where('name', 'LIKE', '%' . $this->search . '%')
                ->select('categories.*')
                ->orWhere('description', 'LIKE', '%' . $this->search . '%')
                ->orderBy('id', 'DESC')
                ->paginate($this->pagination);
        } else {
            $categories = Category::where('name', 'LIKE', '%' . $this->search . '%')
                ->select('categories.*')
                ->orderBy('id', 'DESC')
                ->paginate($this->pagination);
        }


        return view('livewire.categorias.category-component', ['categories' => $categories])->extends('layouts.theme.template')->section('content');
    }

    public function resetUI()
    {
        $this->selected_id = 0;
        $this->name = '';
        $this->description = '';
        $this->resetValidation();
        $this->resetPage();
    }

    public function Store()
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
        ];

        $messages = [
            'name.required' => 'El nombre de la categoria es requerida',
            'description.required' => 'La descripcion de la categoria es requerida'
        ];

        $this->validate($rules, $messages);

        $category = Category::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $category->save();

        $this->resetUI();
        $this->dispatch('add-categoria');
    }

    public function Edit($id)
    {
        $category = Category::find($id, ['id', 'name', 'description']);
        $this->selected_id = $category->id;
        $this->name = $category->name;
        $this->description = $category->description;

        $this->dispatch('show-modal');
    }

    public function Update()
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
        ];

        $messages = [
            'name.required' => 'El nombre de la categoria es requerida',
            'description.required' => 'La descripcion de la categoria es requerida'
        ];

        $this->validate($rules, $messages);

        $category = Category::find($this->selected_id);

        $category->update([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $this->resetUI();
        $this->dispatch('update-categoria');
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy(Category $category)
    {


        if (!$category) {
            return;
        }

        if ($category->productos()->count() > 0) {
            $this->dispatch('not-product');
            return;
        } else {
            $category->delete();
            $this->resetUI();
            $this->dispatch('categoria-delete');
        }
    }


    public function GenerarReporteUnico($id)
    {
        $category = Category::find($id, ['id', 'name', 'description']);
        $this->selected_id = $category->id;
        $this->name = $category->name;
        $this->description = $category->description;

       $pdf = PDF::loadView('pdf.CategoriaUnique', ['category' => $category]);

       return $pdf->download('categoriaunica.pdf');
    }
}
