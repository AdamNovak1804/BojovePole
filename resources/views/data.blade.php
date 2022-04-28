@extends('layouts.app')

@section('content')

<navbar-header></navbar-header>

@foreach ($Battles as $Battle)
{{ $Battle['side1']['Name'] }}
vs
{{ $Battle['side2']['Name'] }}
<br>

@endforeach

<navbar-footer></navbar-footer>

@endsection
