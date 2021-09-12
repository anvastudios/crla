@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Kontaktanfragen Übersicht</div>

                <div class="card-body">
                    <ul class="list-group mb-3">
                    @foreach($tickets as $ticket)
                            <li class="list-group-item">
                                <div class="float-block-ticket">
                                    {{ $ticket->created_at->diffForHumans() }}<br>
                                    @if($ticket->bearbeiter == NULL)
                                        <a class="btn btn-sm btn-outline-primary" href="/bo-setStatusProcessed/{{$ticket->id}}"><i class="fas fa-edit"></i> als bearbeitet markieren</a>
                                    @else
                                        bearbeitet von: <b>{{$ticket->bearbeiter}}</b>
                                    @endif
                                </div>
                                @switch($ticket->status)

                                    @case('neu')
                                    <i class="far fa-envelope"></i>
                                    @break

                                    @case('bearbeitet')
                                    <i class="fas fa-check text-success"></i>
                                    @break

                                    @default
                                    <i class="far fa-envelope-open"></i>

                                @endswitch

                                <a href="/bo-show/{{$ticket->id}}"><b>{{$ticket->name}}</b> ( <a href="mailto:{{$ticket->email}}">{{$ticket->email}}</a> )</a>
                                <br>
                                {{ \App\Http\Controllers\TicketController::shortText($ticket->anfrage) }}
                            </li>
                    @endforeach
                    </ul>
                    {{ $tickets->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
