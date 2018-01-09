<?php

namespace App\Http\Controllers;

use App\Delivery;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'login']);
    }

    public function index()
    {
        return view('user.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $email = $request['email'];
        $password = $request['password'];

        $user = User::where('email', $email)->first();
        if(!$user) return redirect()->back()->with(['error' => 'Unknown user']);

        if(Auth::attempt(['email' => $email, 'password' => $password]))
        {
            return redirect()->route('dashboard');
        }
        else
        {
            return redirect()->back()->with(['error' => 'Email or Password does not match!']);
        }
    }

    public function dashboard()
    {
        $user_id = Auth::id();
        $total_delivery = Delivery::where('user_id', $user_id)->count();
        $pending_delivery = Delivery::where('user_id', $user_id)->where('status', 'Pending')->count();
        $received_delivery = Delivery::where('user_id', $user_id)->where('status', 'Received')->count();
        $inprogress_delivery = Delivery::where('user_id', $user_id)->where('status', 'In Progress')->count();
        $delivered = Delivery::where('user_id', $user_id)->where('status', 'Delivered')->count();
        $returned_delivered = Delivery::where('user_id', $user_id)->where('status', 'Returned')->count();


        $delivery_amount_done = Delivery::where('user_id', $user_id)->where('status', ['Delivered'])->sum('after_charging_amount');
        $delivery_amount_returned = Delivery::where('user_id', $user_id)->where('status', ['Returned'])->sum('returned_on');
        //$delivery_amount_pending = Delivery::where('user_id', $user_id)->where('status', 'Pending')->sum('after_charging_amount');
        //$total_delivery_amount = Delivery::where('user_id', $user_id)->sum('after_charging_amount');

        return view('user.index', compact('total_delivery','received_delivery','delivered','returned_delivered','delivery_amount_done', 'pending_delivery', 'delivery_amount_returned', 'inprogress_delivery'));
    }

    public function deliveries()
    {
        $deliveries = Delivery::where('user_id', Auth::id())->latest()->get();
        return view('user.delivery', compact('deliveries'));
    }

    public function deliveryCreate()
    {
        return view('user.deliveryCreate');
    }

    public function postNewDelivery(Request $request)
    {

        $this->validate($request, [
            'recipient_name' => 'required',
            'recipient_mobile' => 'required|min:11',
            'recipient_address' => 'required',
            'amount' => 'required'
        ]);

        $amount = trim($request['amount']);
        $charge = 50;
        $consignment_id = 'PH'.$this->generateRandomString();

        $delivery = new Delivery();
        $delivery->user_id = Auth::id();
        $delivery->consignment_id = $consignment_id;
        $delivery->recipient_name = trim($request['recipient_name']);
        $delivery->recipient_mobile = trim($request['recipient_mobile']);
        $delivery->recipient_address = $request['recipient_address'];
        $delivery->status = 'Pending';
        $delivery->amount = $amount;
        $delivery->charge = $charge;
        $delivery->after_charging_amount = $amount - $charge;

        $done = $delivery->save();

        if ($done)
        {
            return redirect()->route('deliveries')->with(['success' => 'New delivery is creates']);
        } else {
            return redirect()->route('deliveryCreate')->with(['error' => 'something went wrong. Please try again!']);
        }

    }

    public function invoice()
    {
        return view('user.invoice');
    }

    function generateRandomString($length = 6) {
        $characters = 'ABCDEFGHIJKLM0123456789NOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
