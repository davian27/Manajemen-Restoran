<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;
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
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($photo = $request->file('photo')) {
            $destinationPath = 'photos/';
            $profileImage = date('YmdHis') . "." . $photo->getClientOriginalExtension();
            $photo->move($destinationPath, $profileImage);
            $input['photo'] = "$destinationPath$profileImage";
        }

        Menu::create($input);

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
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($photo = $request->file('photo')) {
            $destinationPath = 'photos/';
            $profileImage = date('YmdHis') . "." . $photo->getClientOriginalExtension();
            $photo->move($destinationPath, $profileImage);
            $input['photo'] = "$destinationPath$profileImage";

            // Delete old photo if exists
            if ($menu->photo) {
                Storage::delete($menu->photo);
            }
        } else {
            unset($input['photo']);
        }

        $menu->update($input);

        return redirect()->route('menus.index')
                        ->with('success', 'Menu updated successfully.');
    }
    
    public function destroy(Menu $menu)
    {
        if ($menu->orders()->count() > 0) {
            return redirect()->route('menus.index')
                            ->with('alert', 'Data ini masih terhubung dengan halaman lain.');
        }
        $menu->delete();
        

        return redirect()->route('menus.index')
                        ->with('success', 'Menu deleted successfully.');
    }
}

 ?>