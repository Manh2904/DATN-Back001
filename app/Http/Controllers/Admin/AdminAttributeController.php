<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequestAttibute;
use App\Models\Attributes;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AdminAttributeController extends Controller
{
    public function index()
    {
        $attributes = Attributes::with('menus:id,name')->orderByDesc('id')->get();
        $viewData = [
            'attributes' => $attributes
        ];
        return view('admin.attribute.index', $viewData);
    }

    public function create()
    {
        $menu = Menu::where('active', 1)->get();
        return view('admin.attribute.create', compact('menu'));
    }

    public function store(AdminRequestAttibute $request)
    {
        $data = $request->except('_token');
        $data['active'] = 1;
        $data['created_at'] = Carbon::now();
        $id = Attributes::InsertGetId($data);
        return redirect()->to('/api-admin/attribute');
    }

    public function active($id)
    {
        $attb = Attributes::find($id);
        if ($attb) $attb->active = !$attb->active;
        $attb->save();
        return redirect()->back();
    }

    public function edit($id)
    {
        $attributes = Attributes::find($id);
        $menu = Menu::where('active', 1)->get();
        return view('admin.attribute.update', compact('menu', 'attributes'));
    }

    public function update(AdminRequestAttibute $request, $id)
    {
        $attributes = Attributes::find($id);
        $data = $request->except('_token');
        $data['updated_at'] = Carbon::now();
        $attributes->update($data);
        return redirect()->to('/api-admin/attribute');

    }

    public function delete($id)
    {
        $attributes = Attributes::find($id);
        if ($attributes) $attributes->delete();
        return redirect()->back();
    }
}
