<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\ApiRegisterRequest;
use App\Http\Requests\ApiChangePassWordRequest;
use App\Http\Requests\ApiUpdateRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Validator;

class ImageController extends Controller
{
    public function upload(Request $request) {
        $image = upload_image('file');
        $data = "";
        if ($image['code'] == 1) {
            $data = $image['name'];
        }
        $viewData = [
            'filename' => pare_url_file($data),
            'status' => 'success'
        ];
        return response()->json($viewData);
    }
}
