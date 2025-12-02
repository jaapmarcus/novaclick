<?php

namespace App\Livewire;

use Livewire\Component;

class Faqcategory extends Component
{
    public $categoryId;

    public function mount($categoryId = null)
    {
        $this->categoryId = $categoryId;
    }

    public function render()
    {

        return view('livewire.faqcategory');
    }

    #[Livewire\Attributes\Computed]
    public function faqs( $categoryId = null )
    {
        if($categoryId){
            return \App\Models\Faq::where('category_id', $categoryId)->orderBy('order')->get();
        }
    }

    #[Livewire\Attributes\Computed]
    public function categoryList( $id = null )
    {
        if($id){
            return \App\Models\Category::where('parent_id', $id)->orderBy('order')->get();
        }
        return \App\Models\Category::orderBy('order')->get();
    }
