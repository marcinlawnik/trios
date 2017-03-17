@extends('layouts.app')

@section('content')
    @include('includes.sideNav')
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
      <a href="{{ url('/solve') }}" class="btn-big btn-success btn--home text-uppercase">Play</a>
      <a href="{{ url('/login') }}" class="btn-big btn--home btn--login text-uppercase">Login</a>
    </div>
    </section>
@endsection
