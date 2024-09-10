<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Models\Role;
use App\Models\StaffTransfer;
use App\Models\Accommodation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller {

    public function index() {
        $pageTitle = 'All Guest';
        $allStaff = Admin::with('role')->get();
        $accommodations = Accommodation::where('status',1)->get();
        $roles = Role::all();
        return view('admin.staff.index', compact('pageTitle', 'allStaff', 'roles', 'accommodations'));
    }
    
    public function transferStaff(){
        $pageTitle = 'Transfer Guest';
        $transferStaff = StaffTransfer::with('accommodation','user','admin')->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->get();
        $accommodations = Accommodation::where('status',1)->when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('id',auth()->guard('admin')->user()->accommodation_id);
        })->get();
        $allStaff = User::all();
        return view('admin.staff.trasnferStaff', compact('pageTitle', 'allStaff', 'transferStaff', 'accommodations'));
    }

    public function status($id) {
        return Admin::changeStatus($id);
    }

    public function save(Request $request, $id = 0) {

        $this->validation($request, $id);
        if ($id) {
            $staff   = Admin::findOrFail($id);
            $message = "Guest updated successfully";
        } else {
            $staff   = new Admin();
            $message = "New staff added successfully";
        }

        $staff->name        = $request->name;
        $staff->username    = $request->username;
        $staff->email       = $request->email;
        $staff->role_id     = $request->role_id;
        $staff->accommodation_id     = $request->accommodation_id;
        $staff->password    = $request->password ? Hash::make($request->password) : $staff->password;
        $staff->save();
        $notify[] = ['success', $message];
        return back()->withNotify($notify);
    }

    private function validation($request, $id) {
        $request->validate([
            'username'    => 'required|unique:admins,username,' . $id,
            'name'        => 'required',
            'email'       => 'required|unique:admins,email,' . $id,
            'role_id'     => 'required|integer|gt:0',
            'password'    => !$id ? 'required|min:6' : 'nullable',
            'accommodation_id'        => 'required',
        ]);
    }

    public function login($id) {
        Auth::guard('admin')->loginUsingId($id);
        return to_route('admin.dashboard');
    }
    
      public function transferSave(Request $request, $id = 0) {

        $request->validate([
            'accommodation_id'          => 'required',
            'staff_id'                  => 'required',
            'transfer_date'             => 'required',
            ]);
            
        $staff = User::where('id', $request->staff_id)->first();
        
        $staff_transfer = StaffTransfer::create([
                    'previous_accommodation'  => $staff->accommodation_id,
                    'accommodation_id'           => $request->accommodation_id,
                    'transfer_date'      => date('Y-m-d H:i:s',strtotime($request->transfer_date)),
                    'staff_id'           => $request->staff_id,
                    'transfer_by'        => auth()->guard('admin')->user()->id,
                    'created_at'         => date('Y-m-d H:i:s'),
                    'updated_at'         => date('Y-m-d H:i:s'),
                ]);
                $staff->update([
                    'accommodation_id'=>$request->accommodation_id
                ]);
        
        
        $notify[] = ['success', 'Guest Transfer Successfully'];
        return back()->withNotify($notify);
    }
}
