<?php

namespace App\Http\Controllers;

use App\Models\DestinationVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $validatedInput =  $request->validate([
            'destination_id' => 'required',
            'rating' => 'required|numeric|min:0|max:5'
        ]);

        $user = Auth::user();

        $existingVote = DestinationVote::where('user_id', $user->id)
            ->where('destination_id', $validatedInput['destination_id'])
            ->first();

        if ($existingVote) {
            return back()->withErrors(['message' => __('errors.already_vote'), 'status' => 'error', 'status_code' => 400]);
        }

        DestinationVote::create([
            'user_id' => $user->id,
            'destination_id' => $validatedInput['destination_id'],
            'rating' => $validatedInput['rating'],
        ]);
        return back()->with('flash', ['status' => 'success', 'status_code' => 202, 'message' => __('succesMessage.save_data')]);
    }

    public function destroy($locale, $id)
    {
        $user = Auth::user();
        $vote = DestinationVote::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        $vote->delete();

        return back()->with('flash', ['status' => 'success', 'status_code' => 202, 'message' => __('succesMessage.delete_data')]);
    }
}
