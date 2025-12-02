<?php

namespace App\Livewire;

use Livewire\Component;

class FaqAdmin extends Component
{
    public $question;
    public $answer;
    public $category_id;
    public $order = 0;

    public $faqToDelete;
    public $showDeleteConfirmation = false;

    public $faqToEdit;
    public $showEditModal = false;
    public $editquestion;
    public $editanswer;
    public $editcategory_id;
    public $editorder;

    public function render()
    {
        return view('livewire.faq-admin');
    }

    public function confirmDeleteCategory($faqId)
    {
        $this->faqToDelete = \App\Models\Faq::find($faqId);
        $this->showDeleteConfirmation = true;
    }


    public function cancelDelete()
    {
        $this->categoryToDelete = null;
        $this->showDeleteConfirmation = false;
    }


    public function confirmDelete($faqId)
    {
        $faq = \App\Models\Faq::find($faqId);
        if ($faq) {
            $faq->delete();
            session()->flash('message', 'FAQ succesvol verwijderd.');
        }
        $this->cancelDelete();
    }

    public function updateFaq($faqId)
    {
        $this ->validate([
            'editquestion' => 'required|string|max:255',
            'editanswer' => 'required|string',
            'editcategory_id' => 'nullable|integer',
            'editorder' => 'nullable|integer',
        ]);
        $faq = \App\Models\Faq::find($faqId);
        if ($faq) {
            $faq->update([
                'question' => $this->editquestion,
                'answer' => $this->editanswer,
                'category_id' => $this->editcategory_id,
                'order' => $this->editorder,
            ]);
            session()->flash('message', 'FAQ succesvol bijgewerkt.');
        }
        $this->cancelEdit();
    }

    public function cancelEdit()
    {
        $this->showEditModal = null;
        $this->showEditModal = false;
    }

    public function editFaq($faqId)
    {
        $this->faqToEdit = \App\Models\Faq::find($faqId);
        $this -> editquestion = $this -> faqToEdit -> question;
        $this -> editanswer = $this -> faqToEdit -> answer;
        $this -> editcategory_id = $this -> faqToEdit -> category_id;
        $this -> editorder = $this -> faqToEdit -> order;
        $this->showEditModal = true;
    }

    public function addFaq()
    {
        $this ->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category_id' => 'nullable|integer',
            'order' => 'nullable|integer',
        ]);
        \App\Models\Faq::create([
            'question' => $this->question,
            'answer' => $this->answer,
            'category_id' => $this->category_id,
            'order' => $this->order,
        ]);
        $this->reset(['question', 'answer', 'category_id', 'order']);
        session()->flash('message', 'FAQ succesvol toegevoegd.');
    }

    #[\Livewire\Attributes\Computed]
    public function faqs(){
        return \App\Models\Faq::all();
    }
}
