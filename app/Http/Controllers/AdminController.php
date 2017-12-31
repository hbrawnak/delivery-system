<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Delivery;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin')->except(['index', 'login']);
    }

    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $email = $request['email'];
        $password = $request['password'];

        $admin = Admin::where('email', $email)->first();
        if(!$admin) return redirect()->back()->with(['error' => 'Unknown admin']);

        if(Auth::guard('admin')->attempt(['email' => $email, 'password' => $password]))
        {
            return redirect()->route('admin.dashboard');
        }
        else
        {
            return redirect()->back()->with(['error' => 'Email or Password does not match!']);
        }
    }

    public function dashboard()
    {
        $users = User::count();
        $delivery = Delivery::count();
        $done_delivery = Delivery::where('status', 'done')->count();
        $pending_delivery = Delivery::where('status', 'pending')->count();
        $total_delivery_amount_after_charge = Delivery::sum('after_charging_amount');
        $total_delivery_amount = Delivery::sum('amount');
        return view('admin.index', compact('users',  'delivery','done_delivery','pending_delivery','total_delivery_amount','total_delivery_amount_after_charge'));
    }

    public function users()
    {
        //$users = User::orderBy('created_at', 'desc')->get();

        $users = DB::table('users')
            ->orderBy('created_at', 'desc')
            ->get();


        return view('admin.users', compact('users'));
    }

    public function createUser()
    {
        return view('admin.userCreate');
    }

    public function postNewUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'mobile' => 'required|min:11',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'mobile' => $request['mobile'],
                'password' => bcrypt($request['password']),
            ]);

        if ($user) {
            return redirect()->route('admin.users')->with(['success' => 'New user is created']);
        } else {

            return redirect()->route('admin.users')->with(['success' => 'User is not created']);

        }

    }

    public function delivery()
    {
        $deliveries = Delivery::orderBy('created_at', 'desc')->get();
        return view('admin.orders', compact('deliveries'));
    }

    public function updateStatus($id)
    {
        $delivery = Delivery::find($id);

        if ($delivery) {
            if ($delivery->status == 'Pending')
            {
                DB::table('deliveries')
                    ->where('id', $id)
                    ->update(['status' => 'Done']);

                return redirect()->back();

            }
            elseif ($delivery->status == 'Done')
            {
                DB::table('deliveries')
                    ->where('id', $id)
                    ->update(['status' => 'Pending']);

                return redirect()->back();
            }
        } else {

            return redirect()->back()->with(['error' => 'Something went wrong']);
        }

    }

    public function logout()
    {
        auth('admin')->logout();
        return redirect()->route('admin.login');
    }
}
