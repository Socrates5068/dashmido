<?php

namespace App\View\Components\Admin;

use App\Models\Department;
use Illuminate\View\Component;

class SideMenu extends Component
{
    public $departments;

    public function __construct()
    {
        $this->departments = Department::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.side-menu');
    }
}
