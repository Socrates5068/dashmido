<?php

namespace App\Http\Livewire\Admin\Consultation;

use App\Models\Order;
use App\Models\Recipe;
use App\Models\Product;
use Livewire\Component;
use App\Models\Department;
use App\Models\Consultation;
use Livewire\WithPagination;

class MedicalConsultation extends Component
{
    use WithPagination;

    public $array, $patient_id;
    public $show = 0;

    // variables for consultation
    public $consult, $conAux, $consultationDescription, $diagnostic;

    // variables for manage orders
    public $orderDescription, $saveControl = 0, $order_id, $aux;

    // variables for recipes
    public $quantity, $medicine, $instruction, $descriptionRecipe = [], $recipeControl = 0, $auxRecipe, $auxRecipeObject;

    // variables for medicines
    public $gnames, $gname, $gnameId;

    public $pro;

    protected $rules = [
        'gnames.*.id' => '',
        'gnames.*.gname' => '',

        'pro.id' => '',
        'pro.gname' => '',
    ];

    protected $listeners = ['save', 'resetVariables', 'resetRecipe'];

    public function mount($patient_id)
    {
        $this->patient_id = $patient_id;
    }

    public function save($status)
    {
        $this->consult = new Consultation();
        $this->consult->patient_id = $this->patient_id;
        $this->consult->staff_id = Auth()->user()->person->staff->id;
        $this->consult->description = $this->consultationDescription;
        $this->consult->status = $status;
        $this->consult->diagnostic = $this->diagnostic;
        $this->consult->save();
        $this->saveControl = 1;

        $this->show = 3;
        $this->editDiagnosis($this->consult);

        // $this->resetVariables();
        $this->emit('saved');
    }

    function saveOrder()
    {
        $order = new Order();
        $order->patient_id = $this->patient_id;
        $order->staff_id = Auth()->user()->person->staff->id;
        $order->consultation_id = $this->consult->id;
        $order->description = $this->orderDescription;
        $order->save();
        $this->order_id = $order->id;

        $this->emit('saved');
    }

    function saveOrderPrint()
    {
        if ($this->saveControl == 0) {
            $this->saveControl = 1;

            $order = new Order();
            $order->patient_id = $this->patient_id;
            $order->staff_id = Auth()->user()->person->staff->id;
            $order->description = $this->orderDescription;
            $order->save();

            $this->order_id = $order->id;
        } else {
            $order = Order::all()->last();
            $order->description = $this->orderDescription;
            $order->save();
        }

        $this->emit('saved');
    }

    public function edit(Order $order)
    {
        $this->aux = $order->id;

        $this->orderDescription = $order->description;
    }

    public function updateOrder(Order $order)
    {
        $order->description = $this->orderDescription;
        $order->save();

        $this->emit('saved');
    }

    public function editDiagnosis(Consultation $consultation)
    {
        $this->consult = $consultation;
        $this->conAux = $consultation->id;
        $this->consultationDescription = $consultation->description;
        $this->diagnostic = $consultation->diagnostic;
    }

    public function updateDiagnosis($status)
    {
        $consultation = Consultation::find($this->conAux);
        $consultation->description = $this->consultationDescription;
        $consultation->status = $status;
        $consultation->diagnostic = $this->diagnostic;
        if ($status === 'TERMINADO') {
            $consultation->fromDepartment = null;
        }
        $consultation->save();

        $this->show = 0;

        $this->resetVariables();
        $this->emit('saved');
    }

    public function addRecipe()
    {
        $this->validate([
            'quantity' => 'required',
            'gname' => 'required',
            'instruction' => 'required'
        ]);

        $description = [];
        array_push($description, $this->quantity, $this->gname, $this->instruction);
        array_push($this->descriptionRecipe, $description);

        // save medicine on database
        $medicine = new Product();
        $medicine->gname = $this->gname;
        $medicine->save();

        $this->reset('quantity', 'medicine', 'instruction');
    }

    public function saveRecipe()
    {
        $recipe = new Recipe();
        $recipe->patient_id = $this->patient_id;
        $recipe->staff_id = Auth()->user()->person->staff->id;
        $recipe->consultation_id = $this->consult->id;
        $recipe->description = json_encode($this->descriptionRecipe);
        $recipe->save();

        $this->resetRecipe();
        $this->emit('saved');
    }

    public function editRecipe($index)
    {
        $this->recipeControl = 1;
        $description = $this->descriptionRecipe[$index];
        $this->quantity =  $description[0];
        $this->medicine = $description[1];
        $this->instruction = $description[2];
        $this->auxRecipe = $index;
    }

    public function updateRecipe()
    {
        $this->validate([
            'quantity' => 'required',
            'medicine' => 'required',
            'instruction' => 'required'
        ]);

        $description = [];
        array_push($description, $this->quantity, $this->medicine, $this->instruction);
        $this->descriptionRecipe[$this->auxRecipe] = $description;
        $this->recipeControl = 0;
        $this->reset('quantity', 'medicine', 'instruction');
    }

    public function editRecipeObecjt(Recipe $recipe)
    {
        $this->auxRecipeObject = $recipe->id;
        $this->descriptionRecipe = json_decode($recipe->description, true);
    }

    public function updateRecipeObject()
    {
        $recipe = Recipe::find($this->auxRecipeObject);
        $recipe->description = json_encode($this->descriptionRecipe);
        $recipe->save();

        $this->reset('quantity', 'medicine', 'instruction');
        $this->emit('saved');
    }

    public function resetVariables()
    {
        $this->reset('orderDescription', 'consultationDescription', 'diagnostic');
        $this->resetValidation();
    }

    public function resetRecipe()
    {
        $this->reset('quantity', 'gname', 'instruction', 'descriptionRecipe');
        $this->resetValidation();
    }

    public function infirmary()
    {
        $this->consult->infirmary = '1';
        $this->consult->save();
        $this->emit('saved');
    }

    public function deriveDepartment($department_id)
    {
        $consultation = Consultation::find($this->conAux);
        $consultation->description = $this->consultationDescription;
        $consultation->diagnostic = $this->diagnostic;
        $consultation->fromDepartment = $department_id;
        $consultation->save();

        $pdf = \PDF::loadView('pdf.derive', [
            'consultation' => $consultation
        ])->setPaper('letter', 'portrait')->output();

        return response()->streamDownload(
            fn () => print($pdf),
            'Orden_derivación_' . now() . '.pdf'
        );
    }

    public function updatedGnameId()
    {
        $this->pro = Product::find($this->gnameId);
    }

    public function updatedGname()
    {
        $this->getGnames();
    }

    public function getGnames()
    {
        $this->gnames = Product::query()
            ->when($this->gname, function ($query, $gname) {
                return $query->where('gname', 'LIKE', '%' . $gname . '%');
            })
            ->orderBy('gname')
            ->get();
    }

    public function printConsultation()
    {
        $consultation = Consultation::find($this->conAux);
        $consultation->description = $this->consultationDescription;
        $consultation->diagnostic = $this->diagnostic;
        $consultation->save();

        $pdf = \PDF::loadView('pdf.consultation', [
            'consultation' => $consultation
        ])->setPaper('letter', 'portrait')->output();

        return response()->streamDownload(
            fn () => print($pdf),
            'Diagnostico_' . now() . '.pdf'
        );
    }

    public function render()
    {
        if ($this->consult) {
            $consultations = Consultation::where('patient_id', $this->patient_id)->orderBy('id', 'desc')->paginate(5);
            $orders = Order::where('patient_id', $this->patient_id)
                ->where('consultation_id', $this->consult->id)
                ->orderBy('id', 'desc')->paginate(5);

            $recipes = Recipe::where('patient_id', $this->patient_id)
                ->where('consultation_id', $this->consult->id)
                ->orderBy('id', 'desc')->paginate(5);

                $departments = Department::where('name', '!=', 'Administración')
                ->where('name', '!=', 'Enfermería')->get();

            return view('livewire.admin.consultation.medical-consultation', compact('consultations', 'orders', 'recipes', 'departments'));
        } else {
            $consultations = Consultation::where('patient_id', $this->patient_id)->orderBy('id', 'desc')->paginate(5);
            $departments = Department::where('name', '!=', 'Administración')
                                    ->where('name', '!=', 'Enfermería')->get();

            return view('livewire.admin.consultation.medical-consultation', compact('consultations', 'departments'));
        }
    }
}
