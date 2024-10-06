<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FibonacciController extends Controller
{

    private function generateFibonacci($n)
    {
        $fib = [0, 1];
        for ($i = 2; $i < $n; $i++) {
            $fib[$i] = $fib[$i - 1] + $fib[$i - 2];
        }
        return $fib;
    }

    public function generate(Request $request)
    {
        $validated = $request->validate([
            'rowCount' => 'required|integer|min:1',
            'columnCount' => 'required|integer|min:1',
        ]);

        $rowCount = $validated['rowCount'];
        $columnCount = $validated['columnCount'];
        $totalCells = $rowCount * $columnCount;

        $fibonacciSequence = $this->generateFibonacci($totalCells);

        $table = '<table class="table table-bordered mt-3"><tbody>';
        $fibIndex = 0;

        for ($i = 0; $i < $rowCount; $i++) {
            $table .= '<tr>';
            for ($j = 0; $j < $columnCount; $j++) {
                $table .= '<td>' . $fibonacciSequence[$fibIndex] . '</td>';
                $fibIndex++;
            }
            $table .= '</tr>';
        }
        $table .= '</tbody></table>';

        return response()->json([
            'table' => $table
        ]);
    }
}
