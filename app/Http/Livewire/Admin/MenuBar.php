<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class MenuBar extends Component
{
    public $application, $content1, $content2, $content3, $content4;

    protected $listeners = ['render'];

    public function render()
    {
        return view('livewire.admin.menu-bar');
    }
}
