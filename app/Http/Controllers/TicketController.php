<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketStatus;
use Auth;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('viewAny', Ticket::class);

        $belongingTickets = Auth::user()->tickets();
        $unresolvedTickets = Auth::user()->isAdmin() ? Ticket::getOpen() : [];

        return view('ticket.index', ['belongingTickets' => $belongingTickets, 'unresolvedTickets' => $unresolvedTickets]);
    }


    public function show(Ticket $id)
    {
        $this->authorize('view', $id, Ticket::class);

        return view('ticket.show', ['ticket' => $id]);
    }

    public function create()
    {
        $this->authorize('create', Ticket::class);

        return view('ticket.create');
    }

    public function store(Request $req)
    {
        $this->authorize('store', Ticket::class);

        Ticket::create([
            'title' => $req->title,
            'description' => $req->description,
            'reporter_id' => Auth::user()->id,
            'status_id' => TicketStatus::getOpenValue()->id
        ]);

        return redirect()->route('ticketIndex');
    }

    public function update(Request $req, Ticket $id)
    {
        $this->authorize('update', $id, Ticket::class);

        Ticket::where('id', $id->id)
            ->update([
                'resolution' => $req->resolution,
                'status_id' => TicketStatus::getSolvedValue()->id,
                'solver_id' => Auth::user()->id
            ]);

        return redirect()->route('admin.ticketShow', ['id' => $id]);
    }
}
