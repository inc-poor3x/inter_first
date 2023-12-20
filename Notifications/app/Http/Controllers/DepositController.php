<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\User;
use App\Notifications\DepositSuccessful;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Handle the deposit request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deposit(Request $request)
    {
        // Validate the request
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        // Create a deposit record
        $deposit = Deposit::create([
            'user_id' => Auth::user()->id,
            'amount'  => $request->amount,
        ]);

        // Notify the user about the successful deposit
        User::find(Auth::user()->id)->notify(new DepositSuccessful($deposit->amount));

        // Redirect back with a success message
        return redirect()->back()->with('status', 'Thank you for your interest in the job');
    }
    public function markAsRead(){
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
