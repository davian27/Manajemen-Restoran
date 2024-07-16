<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::all();
        return view('menus.index', compact('menus'));
    }
    
    public function create()
    {
        return view('menus.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:menus',
            'price' => 'required|numeric',
        ]);

        Menu::create($request->all());

        return redirect()->route('menus.index')
                        ->with('success', 'Menu created successfully.');
    }
    
    public function show(Menu $menu)
    {
        return view('menus.show', compact('menu'));
    }
    
    public function edit(Menu $menu)
    {
        return view('menus.edit', compact('menu'));
    }
    
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required|unique:menus,name,' . $menu->id,
            'price' => 'required|numeric',
        ]);

        $menu->update($request->all());

        return redirect()->route('menus.index')
                        ->with('success', 'Menu updated successfully.');
    }
    
    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('menus.index')
                        ->with('success', 'Menu deleted successfully.');
    }
}

 ?>