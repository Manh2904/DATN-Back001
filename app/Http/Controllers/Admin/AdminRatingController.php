<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rating;

class AdminRatingController extends Controller
{
    public function index()
    {
        $viewData = [
            'rating' => Rating::Paginate(12)
        ];
        return view('admin.rating.index', $viewData);
    }
}
