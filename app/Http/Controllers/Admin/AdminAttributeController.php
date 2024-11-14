<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequestAttibute;
use App\Models\Attributes;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AdminAttributeController extends Controller
{
    public function index()
    {
        $attributes = Attributes::with('category:id,c_name,c_cate')->orderByDesc('id')->get();
        $viewData = [
            'attributes' => $attributes
        ];
        return view('admin.attribute.index', $viewData);
    }

    public function create()
    {
        $category = Category::select('c_cate', 'c_name')->get();
        return view('admin.attribute.create', compact('category'));
    }

    public function store(AdminRequestAttibute $request)
    {
        $data = $request->except('_token');
        $data['atb_slug'] = Str::slug($data['atb_name']);
        $data['created_at'] = Carbon::now();
        $id = Attributes::InsertGetId($data);
        return redirect()->back();
    }

    public function edit($id)
    {
        $attributes = Attributes::find($id);
        $category = Category::select('id', 'c_cate', 'c_name')->get();
        return view('admin.attribute.update', compact('category', 'attributes'));
    }

    public function update(AdminRequestAttibute $request, $id)
    {
        $attributes = Attributes::find($id);
        $data = $request->except('_token');
        $data['atb_slug'] = Str::slug($request->atb_name);
        $data['updated_at'] = Carbon::now();
        $attributes->update($data);
        return redirect()->back();

    }

    public function delete($id)
    {
        $attributes = Attributes::find($id);
        if ($attributes) $attributes->delete();
        return redirect()->back();
    }
}
