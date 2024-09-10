<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExtraService;
use Illuminate\Http\Request;

class ExtraServiceController extends Controller
{
    public function index()
    {
        $pageTitle     = 'Extra Services';
        $extraServices = ExtraService::latest()->get();
        return view('admin.hotel.extra_services', compact('pageTitle', 'extraServices'));
    }

    public function save(Request $request, $id = 0)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:extra_services,name,' . $id,
            'cost' => 'required|integer|gt:0'
        ]);

        if ($id) {
            $extraServices         = ExtraService::findOrFail($id);
            $notification          = 'Service updated successfully';
        } else {
            $extraServices = new ExtraService();
            $notification  = 'Service added successfully';
        }

        $extraServices->name = $request->name;
        $extraServices->cost = $request->cost;

        $extraServices->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function status($id)
    {
        return ExtraService::changeStatus($id);
    }
}
