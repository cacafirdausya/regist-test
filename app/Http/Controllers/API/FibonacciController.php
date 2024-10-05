<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FibonacciController extends Controller
{

    // API method to generate Fibonacci and return as a table
    private function generateFibonacci($n) {
        $fib = [0, 1];
        for ($i = 2; $i < $n; $i++) {
            $fib[$i] = $fib[$i - 1] + $fib[$i - 2];
        }
        return $fib;
    }

    // API method to generate Fibonacci and return as a table
    public function generate(Request $request)
    {
        // Validate request input from query parameters
        $validated = $request->validate([
            'rowCount' => 'required|integer|min:1',
            'columnCount' => 'required|integer|min:1',
        ]);

        // Get row and column count from query parameters
        $rowCount = $validated['rowCount'];
        $columnCount = $validated['columnCount'];
        $totalCells = $rowCount * $columnCount;

        // Generate Fibonacci sequence
        $fibonacciSequence = $this->generateFibonacci($totalCells);

        // Create the table as an HTML string
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

        // Return the table as a JSON response
        return response()->json([
            'table' => $table
        ]);
    }
}
