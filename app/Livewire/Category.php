<?php

namespace App\Livewire;

use Livewire\Component;

class Category extends Component
{
    public $name;
    public $description;
    public $order = 0;

    public $categoryToDelete;
    public $showDeleteConfirmation = false;

    public $categoryToEdit;
    public $showEditModal = false;
    public $editname;
    public $editdescription;
    public $editorder;

    public function render()
    {
        return view('livewire.category');
    }

    public function addCategory()
    {
        // Validate input
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        // Create the category
        \App\Models\Category::create([
            'name' => $this->name,
            'description' => $this->description,
            'order' => $this->order,
        ]);

        // Reset input fields
        $this->reset(['name', 'description', 'order']);
        // Optionally, you can add a success message or emit an event here
        session()->flash('message', 'Categorie succesvol toegevoegd.');
    }

    #[\Livewire\Attributes\Computed]
    public function categories(){
        return \App\Models\Category::orderBy('order')->get();
    }

    function confirmDelete($categoryId)
    {
        $this->categoryToDelete = \App\Models\Category::find($categoryId);
        $this->showDeleteConfirmation = true;
    }

    function cancelDelete()
    {
        $this->categoryToDelete = null;
        $this->showDeleteConfirmation = false;
    }

    function deleteCategoryConfirmed()
    {
        if ($this->categoryToDelete) {
            $this->categoryToDelete->delete();
            session()->flash('message', 'Categorie succesvol verwijderd.');
        }
        $this->cancelDelete();
    }

    function editCategory($categoryId)
    {
        $this->categoryToEdit = \App\Models\Category::find($categoryId);
        $this -> editname = $this -> categoryToEdit -> name;
        $this -> editdescription = $this -> categoryToEdit -> description;
        $this -> editorder = $this -> categoryToEdit -> order;
        $this->showEditModal = true;
    }

    function updateCategory($categoryId)
    {
        $category = \App\Models\Category::find($categoryId);
        if ($category) {
            $category->update([
                'name' => $this -> editname,
                'description' => $this -> editdescription,
                'order' => $this -> editorder,
            ]);
            session()->flash('message', 'Categorie succesvol bijgewerkt.');
        }
        $this->showEditModal = false;
    }


}
