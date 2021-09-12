@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a class="btn btn-sm btn-outline-primary mb-3" href="/kontaktanfrage"><i class="fas fa-edit"></i> zurück</a>
            <div class="card">
                <div class="card-header">
                    <div class="float-right text-right">
                        gestellt am {{ $ticket->created_at->format('d.m.Y | H:i')}}<br>
                        @if($ticket->bearbeiter == NULL)
                            <a class="btn btn-sm btn-outline-primary" href="/bo-setStatusProcessed/{{$ticket->id}}"><i class="fas fa-edit"></i> als bearbeitet markieren</a>
                        @else
                            bearbeitet von: <b>{{$ticket->bearbeiter}}</b><br>
                            bearbeitet am {{ $ticket->updated_at->format('d.m.Y | H:i')}}
                        @endif
                    </div>
                    Kontaktanfrage von {{$ticket->name}}<br>
                    E-Mail:  <a href="mailto:{{$ticket->email}}">{{$ticket->email}}</a> <br>
                    [Status: {{$ticket->status}}]
                </div>
                <div class="card-body">
                    {{ $ticket->anfrage}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
