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
        $today = date("Y-m-d", strtotime(now()));
        $tomorrow = date("Y-m-d", strtotime(now() . " + 1 days"));
        $cards = Card::where('patient_id', auth()->user()->person->patient->id)
            ->whereBetween('date', [$today, $tomorrow])
            ->orderBy('id', 'desc')->get();

        return view('livewire.cards', compact('cards'));
    }
}
