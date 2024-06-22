<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Clinic;
use App\Models\Ticket;
use App\Models\Appointment;
use App\Models\Payment;
use App\Models\ClinicReview;
use App\Policies\UserPolicy;
use App\Policies\ClinicPolicy;
use App\Policies\ClinicReviewPolicy;
use App\Policies\TicketPolicy;
use App\Policies\AppointmentPolicy;
use App\Policies\PaymentPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Clinic::class => ClinicPolicy::class,
        Ticket::class => TicketPolicy::class,
        Appointment::class => AppointmentPolicy::class,
        Payment::class => PaymentPolicy::class,
        ClinicReview::class => ClinicReviewPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
