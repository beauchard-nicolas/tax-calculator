<!-- Vue principale de l'application -->
@extends('layouts.app')

@section('title', 'UK Tax Calculator')

@section('content')
    <!-- Composant d'affichage des tranches d'imposition -->
    <x-tax-bands-table :taxBands="$taxBands" />
    <!-- Composant du formulaire de calcul -->
    <x-calculator-form :request="$request ?? null" />
    <!-- Composant d'affichage des résultats (conditionnel) -->
    @isset($result)
        <x-results-section :result="$result" />
    @endisset
@endsection