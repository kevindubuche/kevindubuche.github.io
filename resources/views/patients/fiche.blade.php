@extends('main')

@section('fichePatient') 
<div class="container">
  @include('patients/fichePatientHtml')

<form action="{{ route('downloadPDF')}}" method="post">
  @csrf
  <input type="hidden" name="id" id="id" value="{{$newPatient->id}}" />
  <input type="submit" class="btn btn-primary btn-xs" value="Telecharger PDF" >
          
  </form>
</div>
@endsection