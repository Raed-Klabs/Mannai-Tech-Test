<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class OrdersController extends Controller
{
    // First part solution
    public function customerWithMostMoneySpent()
{
    $customer = DB::table('customers')
                ->selectRaw('customers.customerNumber, customers.customerName, SUM(payments.amount) AS total_money_spent')
                ->join('payments', 'customers.customerNumber', '=', 'payments.customerNumber')
                ->groupBy('customers.customerNumber')
                ->orderByDesc('total_money_spent')
                ->first();

    return $customer;
}

// Second Part Solution
public function customerWithHighestOrders()
{
    $customer = DB::table('customers')
                ->selectRaw('customers.customerNumber, customers.customerName, COUNT(orders.orderNumber) AS total_orders')
                ->join('orders', 'customers.customerNumber', '=', 'orders.customerNumber')
                ->groupBy('customers.customerNumber')
                ->orderByDesc('total_orders')
                ->first();

    return $customer;
}


}
