<?php

namespace App\Http\Livewire;

use App\Models\Card;
use Livewire\Component;
use Livewire\WithPagination;

class Cards extends Component
{
    use WithPagination;

    public function render()
    {
        $cards = Card::where('patient_id', auth()->user()->person->patient->id)->orderBy('id', 'desc')->paginate(5);

        return view('livewire.cards', compact('cards'));
    }
}
