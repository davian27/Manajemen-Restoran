<?php 
namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['customer', 'employee'])->get();
        return view('reservations.index', compact('reservations'))->with('i', 0);
    }

    public function create()
    {
        $customers = Customer::all();
        $employees = Employee::all();
        return view('reservations.create', compact('customers', 'employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'employee_id' => 'required',
            'reservation_time' => 'required|date',
            'number_of_people' => 'required|integer|min:1',
            'status' => 'required|in:pending,confirmed,canceled',

        ]);
        $activeReservation = Reservation::where('customer_id', $request->customer_id)
                                        ->where('status', '!=', 'canceled')
                                        ->first();

        if ($activeReservation) {
            return redirect()->route('reservations.index')
                             ->with('error', 'Customer already has an active reservation.');
        }

        Reservation::create($request->all());

        return redirect()->route('reservations.index')
                         ->with('success', 'Reservation created successfully.');

        Reservation::create($request->all());

        return redirect()->route('reservations.index')
                        ->with('success', 'Reservation created successfully.');
    }

    public function show(Reservation $reservation)
    {
        $reservation->load(['customer', 'employee']);
        return view('reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        $customers = Customer::all();
        $employees = Employee::all();
        return view('reservations.edit', compact('reservation', 'customers', 'employees'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'customer_id' => 'required',
            'employee_id' => 'required',
            'reservation_time' => 'required|date',
            'number_of_people' => 'required|integer|min:1',
            'status' => 'required|in:pending,confirmed,canceled',
        ]);

        $reservation->update($request->all());

        return redirect()->route('reservations.index')
                        ->with('success', 'Reservation updated successfully.');
    }

    public function destroy(Reservation $reservation)
    {

    
        $reservation->delete();
        return redirect()->route('reservations.index')
                        ->with('success', 'Reservation deleted successfully.');
    }
}

 ?>