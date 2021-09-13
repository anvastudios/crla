<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['create', 'store']);
        $this->middleware('kb')->except(['create', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meldung_success = Session::get('meldung_success');

        $tickets = Ticket::orderBy('created_at', 'DESC')->paginate(10);
        return view('bo.ticket.index')->with([
            'tickets' => $tickets,
            'meldung_success' => $meldung_success
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'name' => 'required|max:255',
                'email' => 'required|email:rfc,dns|max:255',
                'anfrage' => 'required|min:10|max:5000'
            ]
        );

        $ticket = new Ticket(
            [
                'name' => strip_tags($request->name),
                'email' => strip_tags($request->email),
                'anfrage' => strip_tags($request->anfrage),
                'status' => 'neu'
            ]
        );

        $ticket->save();

        return view('ticket.create')->with('meldung_success', 'Vielen Dank <b>'.strip_tags($request->name).'</b> für Ihre Anfrage. Wir bearbeiten diese schnellst möglich.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return view('bo.ticket.show')->with(['ticket' => $ticket]);
    }


    /**
     * @param $longText
     * @return string
     */
    public static function shortText($longText)
    {
        $wordArray = explode(' ', $longText);
        $shortText = '';
        $maxWords = 15;

        if ($maxWords < count($wordArray)){
            for ($x = 0; $x <= $maxWords; $x++){
                $shortText .= $wordArray[$x]." ";
            }
            $shortText = $shortText."...";
        }else{
            $shortText = $longText;
        }

        return $shortText;
    }

    public function setStatusProcessed(Ticket $ticket)
    {
        $ticket->update([
            'status' => 'bearbeitet',
            'bearbeiter' => auth()->user()->name
        ]);

        return back()->with([
            'meldung_success' => 'Die Kontaktanfrage wurde als bearbeitet markiert.'
        ]);
    }
}
