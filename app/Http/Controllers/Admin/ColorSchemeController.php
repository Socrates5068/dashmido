<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ColorSchemeController extends Controller
{
    public function switch(Request $request)
    {
        session([
            'color_scheme' => $request->color_scheme
        ]);

        return back();
    }
}
