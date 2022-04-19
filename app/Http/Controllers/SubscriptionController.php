<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponse;
use App\Models\User;
use App\Models\UserWebsiteSubscriptions;
use App\Models\Website;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    use ApiResponse;

    public function store(User $user, Website $website)
    {
        if (UserWebsiteSubscriptions::where('user_id', $user->id)->where('website_id', $website->id)->exists()) {
            return $this->errorResponse(['subscription' => 'User already subscribed.']);
        }
        $subscription = UserWebsiteSubscriptions::create(['user_id' => $user->id, 'website_id' => $website->id]);
        return $this->successResponse(compact('subscription'));
    }
}
