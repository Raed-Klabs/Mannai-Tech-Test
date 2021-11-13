<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class MvpController extends Controller
{
    public function getMvp() {
        $employees = collect([
            [
                'name' => 'John',
                'email' => 'john3@example.com',
                'sales' => [
                    ['customer' => 'The Blue Rabbit Company', 'order_total' => 7444],
                    ['customer' => 'Black Melon', 'order_total' => 1445],
                    ['customer' => 'Foggy Toaster', 'order_total' => 700],
                ],
            ],
            [
                'name' => 'Jane',
                'email' => 'jane8@example.com',
                'sales' => [
                    ['customer' => 'The Grey Apple Company', 'order_total' => 203],
                    ['customer' => 'Yellow Cake', 'order_total' => 8730],
                    ['customer' => 'The Piping Bull Company', 'order_total' => 3337],
                    ['customer' => 'The Cloudy Dog Company', 'order_total' => 5310],
                ],
            ],
            [
                'name' => 'Dave',
                'email' => 'dave1@example.com',
                'sales' => [
                    ['customer' => 'The Acute Toaster Company', 'order_total' => 1091],
                    ['customer' => 'Green Mobile', 'order_total' => 2370],
                ],
            ],
        ]);

        // Find the highest sale in the collection
        $mostValuableSale = $employees->pluck('sales')
            ->flatten(1)
            ->sortByDesc('order_total')
            ->first();

        // Find the employee who made the sale
        $mostValuableEmployee = $employees->filter(function ($employee) use ($mostValuableSale) {
            return array_search($mostValuableSale, $employee['sales']);
        });

        return $mostValuableEmployee;
    }
}
