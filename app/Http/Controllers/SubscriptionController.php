<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Subscription;
use App\Models\UserSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    public function view()
    {
        $userId = -1;
        $archiveCount = Post::where('user_id', -1)->count();
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $archiveCount = Post::where('status', 'archived')
                        ->where('user_id', $userId)
                        ->count();
        }
        $subs = Subscription::all();
        return view('plans', ['subs' => $subs, 'archiveCount' => $archiveCount]);
    }

    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subscription_id' => ['required'],
            'account_no' => ['required', 'numeric']
        ]);
        // dd($request->subscription_id);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        

        $subscriptionId = $request->subscription_id;
        $bankAccountNumber = $request->account_no;

        $userId = Auth::user()->id;

        $subscription = UserSubscription::where('user_id', $userId)->first();

        if ($subscription) {
            $subscription->subscription_id = $subscriptionId;
            $subscription->bank_account_number = $bankAccountNumber;
            $subscription->save();
        }
        else {
            UserSubscription::create([
                'user_id' => $userId,
                'subscription_id' => $subscriptionId,
                'bank_account_number' => $bankAccountNumber
            ]);
        }
                
        return redirect('/profile');
    }

    public function unsubscribe(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->back()->withErrors(['Login' => 'You are signed out'])->withInput();
        }
        
        $userId = Auth::user()->id;

        $subscription = UserSubscription::where('user_id', $userId)->first();

        if ($subscription) {
            $subscription->delete();
        }
        else {
            return redirect()->back()->withErrors(['Subscription' => 'You are not subscribed to any plans yet'])->withInput();
        }
                
        return redirect('/profile');
    }
}
