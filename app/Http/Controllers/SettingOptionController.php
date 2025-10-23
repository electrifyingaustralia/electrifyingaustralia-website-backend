<?php

namespace App\Http\Controllers;

use App\Models\SettingOption;
use Illuminate\Http\Request;

class SettingOptionController extends Controller
{
    public function index()
    {
        $admin_email = SettingOption::getValue('admin_email');
        $admin_bcc = SettingOption::getValue('admin_bcc');
        $admin_cc = SettingOption::getValue('admin_cc');

        return view('backend.setting.index', compact('admin_email', 'admin_bcc', 'admin_cc'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'admin_email' => 'required|email',
            'admin_bcc' => 'nullable|string',
            'admin_cc' => 'nullable|string'
        ]);

        SettingOption::setValue('admin_email', $request->admin_email);
        SettingOption::setValue('admin_bcc', $request->admin_bcc);
        SettingOption::setValue('admin_cc', $request->admin_cc);

        return redirect()->route('admin.settings.all')
            ->with('success', 'Mail settings updated successfully');
    }
}
