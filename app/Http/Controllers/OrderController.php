<?php 
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Menu;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('customer', 'menu')->get();
        return view('orders.index', compact('orders'))->with('i', 0);
    }

    public function create()
    {
        $customers = Customer::all();
        $menus = Menu::all();
        return view('orders.create', compact('customers', 'menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'menu_id' => 'required',
            'quantity' => 'required',
        ]);

        $menu = Menu::find($request->menu_id);
        $total_price = $menu->price * $request->quantity;

        Order::create([
            'customer_id' => $request->customer_id,
            'menu_id' => $request->menu_id,
            'quantity' => $request->quantity,
            'total_price' => $total_price,
        ]);

        return redirect()->route('orders.index')
                        ->with('success', 'Order created successfully.');
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $customers = Customer::all();
        $menus = Menu::all();
        return view('orders.edit', compact('order', 'customers', 'menus'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_id' => 'required',
            'menu_id' => 'required',
            'quantity' => 'required',
        ]);

        $menu = Menu::find($request->menu_id);
        $total_price = $menu->price * $request->quantity;

        $order->update([
            'customer_id' => $request->customer_id,
            'menu_id' => $request->menu_id,
            'quantity' => $request->quantity,
            'total_price' => $total_price,
        ]);

        return redirect()->route('orders.index')
                        ->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')
                        ->with('success', 'Order deleted successfully.');
    }
}

?>