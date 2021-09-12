@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Kontaktanfrage</div>
                    <div class="card-body">
                        <form autocomplete="off" action="/kontakt" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name*</label>
                                <input type="name" class="form-control {{ $errors->has('name') ? 'border-danger' : ''}}" id="name" name="name" placeholder="Ihr Name" value="{{ old('name') }}">
                                <small class="form-text text-danger">{!! $errors->first('name') !!}</small>
                            </div>
                            <div class="form-group">
                                <label for="email">E-Mail-Adresse*</label>
                                <input type="email" class="form-control {{ $errors->has('email') ? 'border-danger' : ''}}" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}">
                                <small class="form-text text-danger">{!! $errors->first('email') !!}</small>
                            </div>
                            <div class="form-group">
                                <label for="anfrage">Kontaktanfrage*</label>
                                <textarea class="form-control {{ $errors->has('anfrage') ? 'border-danger' : ''}}" id="anfrage" name="anfrage" rows="3">{{ old('anfrage') }}</textarea>
                                <small class="form-text text-danger">{!! $errors->first('anfrage') !!}</small>
                            </div>
                            <p>* Pflichtfelder</p>
                            <input class="btn btn-primary" type="submit" value="Anfrage senden">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
