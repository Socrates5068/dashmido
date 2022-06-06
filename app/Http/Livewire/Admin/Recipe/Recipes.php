<?php

namespace App\Http\Livewire\Admin\Recipe;

use App\Models\Recipe;
use Livewire\Component;
use Livewire\WithPagination;

class Recipes extends Component
{
    use WithPagination;

    public $patient_id;
    public $show = 0;

    protected $listeners = ['saveRecipe'];

    public function mount($patient_id)
    {
        $this->patient_id = $patient_id;
    }

    public function saveRecipe($description)
    {
        $recipe = new Recipe();
        $recipe->patient_id = $this->patient_id;
        $recipe->staff_id = Auth()->user()->person->staff->id;
        $recipe->description = $description;
        $recipe->save();
        $this->show = 0;

        $this->emit('saved');
    }

    public function render()
    {
        $recipes = Recipe::where('patient_id', $this->patient_id)->orderBy('created_at', 'desc')->paginate(5);

        return view('livewire.admin.recipe.recipes', compact('recipes'));
    }
}
