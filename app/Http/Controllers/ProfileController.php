<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\UserLike;
use App\Models\UserSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function view()
    {
        $archiveCount = Post::where('user_id', -1)->count();
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $archiveCount = Post::where('status', 'archived')
                        ->where('user_id', $userId)
                        ->count();
        }
        $user = Auth::user();
        if ($user->display_picture_path) {
            $profile_picture = 'storage/images/'.$user->display_picture_path;
        }
        else {
            $profile_picture = 'storage/asset/gg--profile.png';
        }
        $topPosts = Post::leftJoin('user_likes', 'posts.id', '=', 'user_likes.post_id')
                ->select('posts.id', 'posts.user_id', 'posts.programming_language_id', 'posts.post_id', 'posts.post_content', DB::raw('COUNT(user_likes.id) as like_count'))
                ->where('posts.user_id', $user->id)
                ->groupBy('posts.id', 'posts.user_id', 'posts.programming_language_id', 'posts.post_id', 'posts.post_content')
                ->orderByDesc('like_count')
                ->limit(3)
                ->get();
        $totalLikeCount = UserLike::join('posts', 'user_likes.post_id', '=', 'posts.id')
                        ->where('posts.user_id', $user->id)
                        ->count();
        $totalPostLiked = UserLike::where('user_id', $user->id)->count();
        $membership = UserSubscription::where('user_id', $user->id)->first();
        return view('profile', ['user' => $user, 'top_posts' => $topPosts, 'total_like_count' => $totalLikeCount, 'total_post_like' => $totalPostLiked, 'membership' => $membership, 'profile_picture' => $profile_picture, 'archiveCount' => $archiveCount]);
    }

    public function viewEditProfile()
    {
        $archiveCount = Post::where('user_id', -1)->count();
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $archiveCount = Post::where('status', 'archived')
                        ->where('user_id', $userId)
                        ->count();
        }
        $user = Auth::user();
        if ($user->display_picture_path) {
            $profile_picture = 'storage/images/'.$user->display_picture_path;
        }
        else {
            $profile_picture = 'storage/asset/gg--profile.png';
        }
        return view('edit_profile', ['profile_picture' => $profile_picture, 'archiveCount' => $archiveCount]);
    }

    public function editProfile(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'dob' => ['required', 'date'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else if ($request->has('new_password') && $request->new_password!="") {
            $validator = Validator::make($request->new_password, [
                'new_password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/']
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
        $user = Auth::user();
        if ($request->has('new_password') && Auth::attempt(['email' => $user->email, 'password' => $request->old_password])) {
            $user->password = bcrypt($request->new_password);
        }
        if ($request->has('dob')) {
            $user->dob = $request->dob;
        }
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/images'), $imageName);
            $user->display_picture_path = $imageName;
        }
        $user->save();
        return redirect('profile')->with('success', 'Profile updated successfully.');
    }
}
