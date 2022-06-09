<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Recipe;
use Illuminate\Http\Request;

class PDFExport extends Controller
{
    public function show($id)
    {
        $recipe = Recipe::find($id);
        return view('pdf.recipeShow', compact('recipe'));
    }

    public function showOrder($id)
    {
        $order = Order::find($id);
        return view('pdf.orderShow', compact('order'));
    }

    public function recipe($id)
    {
        $recipe = Recipe::find($id);
        $name = $recipe->patient->person->name . $recipe->patient->person->f_last_name . $recipe->created_at. '.pdf';
        
        $pdf = \PDF::loadView('pdf.recipe', compact('recipe'));
        $pdf ->setPaper('a5','portrait');
     
        return $pdf->download($name);
    }

    public function order($id)
    {
        $order = Order::find($id);
        $name = $order->patient->person->name . $order->patient->person->f_last_name . $order->created_at. 'orden.pdf';
        
        $pdf = \PDF::loadView('pdf.order', compact('order'));
        $pdf ->setPaper('a5','portrait');
     
        return $pdf->download($name);
    }
}
