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
        $pending_delivery = Delivery::where('status', 'Pending')->count();
        $received_delivery = Delivery::where('status', 'Received')->count();
        $inprogress_delivery = Delivery::where('status', 'In Progress')->count();
        $done_delivery = Delivery::where('status', 'Delivered')->count();
        $returned_delivery = Delivery::where('status', 'Returned')->count();
        $total_delivery_amount_after_charge = Delivery::sum('after_charging_amount');
        $total_delivery_amount = Delivery::sum('amount');
        $return_delivery_amount = Delivery::sum('returned_on');

        return view('admin.index', compact('users',  'delivery','received_delivery','inprogress_delivery','done_delivery','received_delivery','pending_delivery','returned_delivery','total_delivery_amount','total_delivery_amount_after_charge','return_delivery_amount'));
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
                    ->update(['status' => 'Received']);

                return redirect()->back()->with(['success' => 'Delivery received.']);

            }
            elseif ($delivery->status == 'Received')
            {
                DB::table('deliveries')
                    ->where('id', $id)
                    ->update(['status' => 'Pending']);

                return redirect()->back()->with(['success' => 'Delivery pending.']);
            }
        } else {

            return redirect()->back()->with(['error' => 'Something went wrong.']);
        }

    }

    public function inProgress($id)
    {
        $delivery = Delivery::find($id);

        if ($delivery)
        {
            DB::table('deliveries')
                ->where('id', $id)
                ->update(['status' => 'In Progress']);

            return redirect()->back()->with(['success' => 'Delivery in progress.']);
        } else {

            return redirect()->back()->with(['error' => 'Something went wrong.']);
        }
    }

    public function delivered($id)
    {
        $delivery = Delivery::find($id);

        if ($delivery)
        {
            DB::table('deliveries')
                ->where('id', $id)
                ->update(['status' => 'Delivered']);

            return redirect()->back()->with(['success' => 'Product is delivered.']);
        } else {

            return redirect()->back()->with(['error' => 'Something went wrong.']);
        }
    }

    public function returned($id)
    {
        $delivery = Delivery::find($id);

        $amount = $delivery->amount;
        $after_charging_amount = $delivery->after_charging_amount;
        $rest_amount = $amount - $after_charging_amount;

        if (!$delivery)
        {
            return redirect()->back()->with(['error' => 'Something went wrong.']);

        } else
        {
            DB::table('deliveries')
                ->where('id', $id)
                ->update([
                    'status' => 'Returned',
                    'returned_on' => $after_charging_amount,
                    'amount' => $rest_amount
                ]);

            return redirect()->back()->with(['success' => 'Product is returned.']);
        }
    }

    public function logout()
    {
        auth('admin')->logout();
        return redirect()->route('admin.login');
    }
}
