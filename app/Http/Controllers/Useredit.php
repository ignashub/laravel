<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
//use Faker\Provider\Image as ProviderImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use View;

class Useredit extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function index()
//    {
//        //
//    }
//
//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        //
//    }
//
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        //check for correct user

        if (Gate::denies('create-post')) {
            // The current user can't update the post...
            return redirect('/')->with('error', 'Unauthorized Page');
        }
        else{
            // The current user can update the post...
            return view::make('auth.edit')->with('user', $user);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'new-password' => ['nullable', 'string', 'min:8'],
        ]);
        if($request->input('name')== '' && $request->input('email')== '' && $request->input('password')== ''){
            return redirect()->back()->with("error","No changes");
        }
        if($request->input('name')!= ''){$user->name = $request->input('name');}
        if($request->input('email')!= ''){$user->email = $request->input('email');}
        if($request->input('password')!= ''){
            $old_password = $request->input('password');
            if(Hash::check($old_password, Auth::user()->password)){
                $user->password = Hash::make($request->input('new-password'));
            }
            else{
                return redirect()->back()->with("error","Old password does not match");
            }
        }
//        $user->password = $request->input('email'); TODO
        $user->save();

        return redirect('/dashboard')->with('success', 'User account has been updated');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
        return redirect('/posts')->with('success', 'Your account has been terminated');
    }

    public function show_all(){
        if (Gate::denies('super_user')) {
            // The current user can't update the post...
            return redirect('/')->with('error', 'Unauthorized Page');
        }
        else{
            $users = User::orderBy('id', 'asc')->paginate(10);
            $posts = Post::all();
            return view('auth.admin')->withUsers($users)->withPosts($posts);
        }
    }
    public function export(){
            return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function update_avatar(Request $request){
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);

        $user = Auth::user();

        $avatarName = $user->id.'avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
        $directory = public_path('/images/');
        $pixelDirectory = public_path('/images/pixelated_avatars/');
        $imageUrl = $directory.$avatarName;
        $pixelUrl = $pixelDirectory.$avatarName;
        Image::make($request->avatar)->fit(250, 250)->insert(public_path('/images/watermark/watermark.png'))->save($imageUrl);
        Image::make($request->avatar)->fit(250, 250)->pixelate(12)->insert(public_path('/images/watermark/watermark.png'))->save($pixelUrl);

        $user->avatar = $avatarName;
        $user->save();

        return back();
    }
}
