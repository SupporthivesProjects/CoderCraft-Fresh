<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{BusinessSetting, Currency};
use Illuminate\Support\Facades\{Artisan, Log};
use Exception;

class BusinessSettingsController extends Controller
{
    public function update(Request $request)
    {
        try {
            foreach ($request->types as $type) {
                $setting = BusinessSetting::firstOrNew(['type' => $type]);
                $setting->value = $request[$type];
                $setting->save();
            }
            return back()->with('success', 'Settings updated successfully');
        } catch (Exception $e) {
            Log::error('Settings update error: ' . $e->getMessage());
            return back()->with('error', 'Failed to update settings');
        }
    }

    public function updateActivationSettings(Request $request)
    {
        try {
            $setting = BusinessSetting::firstOrNew(['type' => $request->type]);
            $setting->value = $request->value;
            $setting->save();

            if ($request->type == 'maintenance_mode') {
                $request->value == '1' ? Artisan::call('down') : Artisan::call('up');
            }
            return '1';
        } catch (Exception $e) {
            Log::error('Activation settings error: ' . $e->getMessage());
            return '0';
        }
    }

    public function vendor_commission()
    {
        try {
            $business_settings = BusinessSetting::where('type', 'vendor_commission')->first();
            return view('admin.business_settings.vendor_commission', compact('business_settings'));
        } catch (Exception $e) {
            Log::error('Vendor commission view error: ' . $e->getMessage());
            return back()->with('error', 'Unable to load commission settings');
        }
    }

    public function vendor_commission_update(Request $request)
    {
        try {
            $setting = BusinessSetting::where('type', $request->type)->first();
            $setting->value = $request->value;
            $setting->save();
            return back()->with('success', 'Commission updated successfully');
        } catch (Exception $e) {
            Log::error('Commission update error: ' . $e->getMessage());
            return back()->with('error', 'Failed to update commission');
        }
    }

    protected function overWriteEnvFile($type, $value)
    {
        try {
            $path = base_path('.env');
            if (file_exists($path)) {
                $value = '"'.trim($value).'"';
                $envFile = file_get_contents($path);
                
                if(strpos($envFile, $type) !== false) {
                    file_put_contents($path, str_replace(
                        $type.'="'.env($type).'"', 
                        $type.'='.$value, 
                        $envFile
                    ));
                } else {
                    file_put_contents($path, $envFile."\n".$type.'='.$value);
                }
            }
        } catch (Exception $e) {
            Log::error('Env file update error: ' . $e->getMessage());
            throw new Exception('Failed to update environment file');
        }
    }
}
