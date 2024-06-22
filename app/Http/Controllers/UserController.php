<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProfilePhoto;
use App\Models\UserType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
use Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('viewAny', User::class);

        $users = User::all();
        return view('user.index', ['users' => $users]);
    }

    public function show(User $id)
    {
        $this->authorize('view', $id, User::class);

        return view('user.show', ['user' => $id]);
    }

    public function create()
    {
        $this->authorize('create', User::class);

        return view('user.create');
    }

    public function store(Request $req)
    {
        $this->authorize('store', User::class);

        $validator = Validator::make($req->all(), [
            'photo' => 'image|max:2048',
            'email' => 'required|email|unique:users,email'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $doctorType = UserType::where('type', 'DOCTOR')->first();
        $newUser = User::create(
            [
                'name' => $req->name,
                'email' => $req->email,
                'phone' => $req->phone,
                'address' => $req->address,
                'password' => Hash::make($req->password),
                'user_type_id' => $req->userType,
                'clinic_id' => $req->userType == $doctorType->id ? $req->employer : null,
                'bio' => $req->userType == $doctorType->id ? $req->bio : null
            ]
        );

        if($req->userType == $doctorType->id) {
            $profilePath = 'public/profilePictures/' . $newUser->id . '/profile.png';
            if(Storage::disk('local')->exists($profilePath))
                Storage::delete($profilePath);

            Storage::disk('local')->put($profilePath, file_get_contents($req->file('photo')));
        }

        return redirect()->route('admin.userIndex');
    }

    public function edit(Request $req, User $id)
    {
        $this->authorize('edit', $id, User::class);
    
        return view('user.edit', ['user' => $id]);
    }

    public function update(Request $req, User $id)
    {
        $this->authorize('edit', $id, User::class);

        User::where('id', $id->id)
            ->update([
                'name' => $req->name,
                'email' => $req->email,
                'address' => $req->address,
                'phone' => $req->phone,
                'bio' => $req->bio
            ]);

        if($id->isDoctor() && !empty($req->file('photo'))) {
            $profilePath = 'public/profilePictures/' . $id->id . '/profile.png';
            if(Storage::disk('local')->exists($profilePath))
                Storage::delete($profilePath);

            Storage::disk('local')->put($profilePath, file_get_contents($req->file('photo')));
        }

        if(Auth::user()->isAdmin())
            return redirect()->route('admin.userShow', ['id' => $id]);
        else
            return redirect()->route('userShow', ['id' => $id]);
    }
}
