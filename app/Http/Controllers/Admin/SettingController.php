<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends AdminBaseController
{
    //Show page for view all cards of setting
    public function settingView()
    {
        try {
            $charges = ['radius', 'admin_commission', 'auto_refill_limit', 'cancel_job_charges', 'referral_bonus','auto_accept_proposal_after_mins','send_job_requests_to_remaining_providers_after_mins'];
            $setting_value = Setting::wherein('field_key', $charges)->get();
            return view('admin.generalsettings.setting.index', compact('setting_value'));
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Show Popup for edit setting
    public function showModel($status)
    {
        try {
            $setting_value = Setting::where('field_key', $status)->first();
            return view('admin.generalsettings.setting._edit_setting', compact('setting_value', 'status'));
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }

    //Update setting
    public function updateSetting(Request $request)
    {
        try {
            $setting_value = Setting::where('field_key', $request->status)->update(['field_value' => $request->value]);
            return redirect()->back()->with('success', $request->status . '   have been Successfully Updated');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!', 'error' => $th->getMessage()]);
        }
    }
}
