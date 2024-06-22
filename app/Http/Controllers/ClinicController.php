<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Clinic;
use App\Models\ClinicReview;
use Illuminate\Http\Request;
use App\Models\ClinicService;
use Illuminate\Support\Facades\Auth;

class ClinicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('viewAny', Clinic::class);

        $clinics = Clinic::all();

        return view('clinic.index', ['clinics' => $clinics]);
    }

    public function show(Clinic $id)
    {
        
        $this->authorize('view', $id, Clinic::class);

        $clinicReviewsCount = $id->reviews()->count();

        return view('clinic.show', ['clinic' => $id, 'reviewsCount' => $clinicReviewsCount]);
    }

    public function create()
    {
        $this->authorize('create', Clinic::class);

        return view('clinic.create');
    }

    public function store(Request $req)
    {
     
        $this->authorize('store', Clinic::class);

        $createdClinic = Clinic::create([
            'name' => $req->name,
            'city_id' => $req->city,
            'address' => $req->address,
            'description' => $req->description,
            'link' => $req->link,
            'homepage' => $req->homepage
        ]);

        for($i = 0; $i < count($req->services); $i++)
            ClinicService::create([
                'clinic_id' => $createdClinic->id,
                'name' => $req->services[$i],
                'price' => $req->prices[$i],
            ]);

        return redirect()->route('admin.clinicIndex');
    }

    public function edit(Request $req, Clinic $id)
    {
        $this->authorize('edit', $id, Clinic::class);
    
        return view('clinic.edit', ['clinic' => $id]);
    }

    public function update(Request $req, Clinic $id)
    {
        $this->authorize('edit', $id, Clinic::class);
        
        ClinicService::where('clinic_id', $id->id)
            ->whereNotIn('name', $req->services)
            ->update(['clinic_id' => null]);

        for($i = 0; $i < count($req->services); $i++)
            ClinicService::updateOrCreate(
            [ 
                'clinic_id' => $id->id,
                'name' => $req->services[$i]
            ],
            [
                'price' => $req->prices[$i]
            ]);

        Clinic::where('id', $id->id)
            ->update([
                'name' => $req->name,
                'city_id' => $req->city,
                'address' => $req->address,
                'description' => $req->description,
                'link' => $req->link,
                'homepage' => $req->homepage
            ]);

        return redirect()->route('admin.clinicShow', ['id' => $id]);
    }

    public function subscribe(Request $req, Clinic $id)
    {
        if(!$id->hasUserSubscribed(Auth::user()))
            $id->users()->attach(Auth::user());

        return redirect()->route('clinicShow', ['id' => $id]);
    }

    public function unsubscribe(Request $req, Clinic $id)
    {
        if($id->hasUserSubscribed(Auth::user()))
            $id->users()->detach(Auth::user());

        return redirect()->route('clinicShow', ['id' => $id]);
    }
}
