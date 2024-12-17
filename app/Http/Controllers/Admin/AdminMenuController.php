<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminMenuController extends Controller
{
    public function index()
    {
        $menu = Menu::all();
        $viewData = [
            'menu' => $menu
        ];
        return view('admin.menu.index', $viewData);
    }

    public function create()
    {
        return view('admin.menu.create');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['active'] = 1;
        $data['slug'] = Str::slug($data['name']);
        $data['created_at'] = Carbon::now();
        $id = Menu::insertGetId($data);
        return redirect()->to('/api-admin/menu');
    }

    public function active($id)
    {
        $menu = Menu::find($id);
        if ($menu) $menu->active = !$menu->active;
        $menu->save();
        return redirect()->back();
    }

    public function hot($id)
    {
        $menu = Menu::find($id);
        if ($menu) $menu->mn_hot = !$menu->mn_hot;
        $menu->save();
        return redirect()->back();
    }

    public function delete($id)
    {
        $menu = Menu::find($id);
        if ($menu) $menu->delete();
        return redirect()->back();
    }

    public function edit($id)
    {
        $menu = Menu::find($id);
        return view('admin.menu.update', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);
        $data = $request->except('_token');
        $data['slug'] = Str::slug($data['name']);
        $data['updated_at'] = Carbon::now();
        $menu->update($data);
        return redirect()->to('/api-admin/menu');
    }
}
