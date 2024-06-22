<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\ClinicReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClinicReviewController extends Controller
{

    public function show() {
    }

    public function create(Clinic $id) {
        return view('clinic.review.create', ['clinicId' => $id->id]);
    }

    public function store(Request $req) {
        
        $clinic = Clinic::find($req->clinicId);

        $newReview = ClinicReview::create([
            'rate' => $req->rate,
            'comment' => $req->comment,
            'reviewer_id' => Auth::user()->id,
            'clinic_id' => $clinic->id
        ]);

        return redirect()->route('clinicReviewsIndex', ['id' => $clinic->id]);
    }

    public function index(Request $req, Clinic $id) {

        $clinicReviews = $id->reviews;
        return view('clinic.review.index', ['clinicReviews' => $clinicReviews]);
    }
}
