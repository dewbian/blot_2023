@extends('layouts.app')  

@section('content')  
<portfolio_root_vue></portfolio_root_vue>
    <component v-bind:this="Portfolio_root"></component>
@endsection
