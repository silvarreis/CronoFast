<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\TimePart;



class TimePartController extends Controller
{
    public function index()
    {
        $totalCalcMargem = [];
        $timeParts = TimePart::with('internalReference', 'employee', 'operation', 'times')
        ->where('user_id',Auth::id())->get()->map(function ($item) use (&$totalCalcMargem) {
            
            $laps = $item->times->pluck('lap_time');
            $somaTotal = function ($array) {
                $totalSegundos = 0;
                foreach ($array as $time) {
                    [$hh, $mm, $ss] = explode(':', $time);
                    $totalSegundos += ($hh * 3600) + ($mm * 60) + (float)$ss;
                }
                return $totalSegundos;
            };
            
            $media = (($somaTotal($laps) / $laps->count()) * $item->production_pace) / 100;
            $calcMargem = $media + ($media * ($item->margin_value / 100));
            $refs = $item->internalReference->ref_code;
            $grup = $item->center_work;
            
            if (!isset($totalCalcMargem[$refs][$grup])) {
                $totalCalcMargem[$refs][$grup] = 0;
            }
            $totalCalcMargem[$refs][$grup] += $calcMargem * 0.01;
            return [
                'id'              => $item->id,
                'center_work'     => $item->center_work,
                'margin'          => $item->margin_value,
                'reference'       => $item->internalReference->ref_code ?? null,
                'production_pace' => $item->production_pace,
                'employee'        => $item->employee->name,
                'operation'       => $item->operation->description,
                'calcByEmployee'  => number_format($calcMargem, 2, ',', '.')
            ];
        })->groupBy(['center_work','reference']);
        

        return view('dashboard', compact('timeParts', 'totalCalcMargem'));
    }
    public function show($id)
    {
        $dataHoraBr = now()->format('d/m/Y H:i:s');
        $date = now()->format('dmy');
        $totalCalcMargem = [];
        $timeParts = TimePart::with('internalReference', 'employee', 'operation', 'times')
        ->where('user_id',Auth::id())->get()->map(function ($item) use (&$totalCalcMargem) {
            
            $laps = $item->times->pluck('lap_time');

            $lapsAssociadas = $item->times->select('id','lap_time', 'lap_number')->toArray();

            $somaTotal = function ($array) {
                $totalSegundos = 0;
                foreach ($array as $time) {
                    [$hh, $mm, $ss] = explode(':', $time);
                    $totalSegundos += ($hh * 3600) + ($mm * 60) + (float)$ss;
                }
                return $totalSegundos;
            };
            
            $media = (($somaTotal($laps) / $laps->count()) * $item->production_pace) / 100;
            $calcMargem = $media + ($media * ($item->margin_value / 100));
            $refs = $item->internalReference->ref_code;
            $grup = $item->center_work;
            
            if (!isset($totalCalcMargem[$refs][$grup])) {
                $totalCalcMargem[$refs][$grup] = 0;
            }
            $totalCalcMargem[$refs][$grup] += $calcMargem * 0.01;

            return [
                'id'              => $item->id,
                'center_work'     => $item->center_work,
                'margin'          => $item->margin_value,
                'reference'       => $item->internalReference->ref_code ?? null,
                'production_pace' => $item->production_pace,
                'employee'        => $item->employee->name,
                'operation'       => $item->operation->description,
                'calcByEmployee'  => number_format($calcMargem, 2, ',', '.'),
                'lap'             => $lapsAssociadas
            ];

        })->where('center_work', $id)->groupBy(['center_work','reference']);
        
        $isPdf = false;

        if (request()->has('pdf')) {
            $isPdf = true;
            $pdf = Pdf::loadView(
                'layouts.detailedListRef',
                compact(
                    'timeParts',
                    'totalCalcMargem',
                    'dataHoraBr', 
                    'isPdf'
                )
            );
            return $pdf->download("{$id}_{$date}.pdf");
        }
       
        return view('layouts.detailedListRef', 
            compact('timeParts', 'totalCalcMargem', 'dataHoraBr', 'isPdf')
        );
    }
    public function store(Request $request)
    {   
        $data = $request->all();
        $time_part_id = auth()->user()->timeparts()->create([
            'internal_reference_id' => $data['internal_reference_id'],
            'employee_id'     => $data['employee_id'],
            'operation_id'    => $data['operation_id'],
            'center_work'     => $data['center_work'],
            'margin_value'    => $data['margin_value'],
            'production_pace' => $data['production_pace'],
            'num_repetition'  => $data['num_repetition'],
        
        ]);
        foreach($data['times'] as $times) {
            [$num ,$time, $lap] = explode(",", $times);
            auth()->user()->times()->create([
                'time_part_id' => $time_part_id->id,
                'lap_number'   => trim($num),
                'total_time'   => trim($time),
                'lap_time'     => trim($lap),
            ]);
        }
    }
    public function delete($ref, $id)
    {
        TimePart::find($id)->delete();
    }
}
