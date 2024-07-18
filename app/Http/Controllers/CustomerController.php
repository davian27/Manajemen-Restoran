<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Reservation;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }
    
    public function create()
    {
        return view('customers.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:customers',
            'phone' => 'required|unique:customers',
        ]);
    
        Customer::create($request->all());
    
        return redirect()->route('customers.index')
                        ->with('success', 'Customer created successfully.');
    }
    
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }
    
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }
    
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:customers,email,' . $customer->id,
            'phone' => 'required|unique:customers,phone,' . $customer->id,
        ]);
    
        $customer->update($request->all());
    
        return redirect()->route('customers.index')
                        ->with('success', 'Customer updated successfully.');
    }
    
    public function destroy(Customer $customer)
    {
        if (Order::where('customer_id', $customer->id)->exists() || (Reservation::where('customer_id', $customer->id)->exists())) {
            return redirect()->route('customers.index')
                             ->with('error', 'Customer cannot be deleted because it is associated with orders.');
        }
        $customer->delete();
    
        return redirect()->route('customers.index')
                        ->with('success', 'Customer deleted successfully.');
    }
}    
