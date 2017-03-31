@extends('layouts.app')

@section('content')
    <section class="home">
    <div class="home--logo">
    @include('includes.trio-logo')
    </div>

    <div>
      <p class="center-block text-center home--info">
          Trios is a simple exercise to test your English skills.<br>
          You should put in a single word that fits all three sentences.<br>
          Have fun!
      </p>
      <a href="{{ url('/solve') }}" class="btn btn-big btn-success btn--home text-uppercase">Play</a>
      @if(!Auth::check())
            <a href="{{ url('/register') }}" class="btn btn-big btn--home btn--login text-uppercase">Register</a>
            <a class="btn btn-link center-block" href="{{ url('/login') }}">
                Already have an account? Sign in
            </a>
      @endif
    </div>
    </section>
@endsection
