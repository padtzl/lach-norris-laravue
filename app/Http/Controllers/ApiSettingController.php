<?php

namespace App\Http\Controllers;

use App\Models\ApiSetting;
use Illuminate\Http\JsonResponse;

class ApiSettingController extends Controller
{

    public function index() {
       $setting = ApiSetting::where('key', 'api_enabled')->first();

        return response()->json(['api_enabled' => $setting->value]);
    }
    public function toggle(): JsonResponse
    {
        $setting = ApiSetting::where('key', 'api_enabled')->first();

        if ($setting) {
            $setting->update(['value' => !$setting->value]);
        } else {
            $setting = ApiSetting::create([
                'key' => 'api_enabled',
                'value' => false
            ]);
        }

        return response()->json(['api_enabled' => $setting->value]);
    }
}
