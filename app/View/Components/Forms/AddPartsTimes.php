<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\InternalReference;
use App\Models\Operation;
use App\Models\Employee;

class AddPartsTimes extends Component
{
    public $employees;
    public $operations;
    public $internalReferences;

    public function __construct()
    {
        $this->employees = Employee::where('user_id', auth()->id())
        ->pluck('name','id');

        $this->operations = Operation::where('user_id', auth()->id())
        ->pluck('description', 'id');

        $this->internalReferences = InternalReference::where('user_id', auth()->id())
        ->pluck('ref_code', 'id');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.add-parts-times');
    }
}
