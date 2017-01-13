@extends('layouts.app')

@section('content')
  <section class="home">

    @yield('content')
    @include('includes.trio-logo')

    <div>
      <p class="center-block text-center home--info">
          Trios is a simple exercise to test your english skills.<br>
          You should put in a single word that fits in all three sentences.<br>
          Have fun!
      </p>
      <a href="{{ action('SolveController@getRandom') }}" class="btn btn-success btn--home text-uppercase">Play</a>
      <a href="{{ url('/login') }}" class="btn btn--home btn--login text-uppercase">Login</a>
    </div>
  </section>

@endsection
