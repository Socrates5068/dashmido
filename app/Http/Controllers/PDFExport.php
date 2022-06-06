<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class PDFExport extends Controller
{
    public function show($id)
    {
        $recipe = Recipe::find($id);
        return view('pdf.recipe', compact('recipe'));
    }

    public function recipe($id)
    {
        $recipe = Recipe::find($id);
        $name = $recipe->patient->person->name . $recipe->patient->person->f_last_name . $recipe->created_at. '.pdf';
        
        $pdf = \PDF::loadView('pdf.recipe', compact('recipe'));
     
        return $pdf->download($name);
    }
}
