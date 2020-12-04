<?php $date_rendez_vous = Session::get('date_rendez_vous'); ?>
@extends('main')

@section('formulaireRendezVous') 
<div class="container" style="margin-top: 150px">
      <!-- ======= Appointment Section ======= -->
      <section id="appointment" class="appointment section-bg">
        <div class="container">
  
          <div class="section-title">
            <h2>Prendre un rendez-vous</h2>
            <p>Remplissez le formulaire suivant pour prendre un rendez-vous afin d’effectuer le test. Apres la soumission, vous recevrez un fichier PDF que vous devriez imprimer ou photographier (à apporter comme preuve). Noter que les tous champs sont obligatoires.</p>
          </div>

          <form action="{{ route('patients.store') }}" method="post" role="form" >
            @csrf

            @isset($date_rendez_vous)
            <div class="form-row">
              <div class="col-md-12 form-group text-center">
                <label>Date du rendez-vous</label>
                <h1><strong style="color: green">{{$date_rendez_vous->format('d M Y') }}</strong></h1>
                <h6>Choisir "Proposition d'une date de rendez-vous" si cette date ne vous convient pas !</h6><hr>
             </div>
            </div>
            @endisset

            <div class="form-row">
              <div class="col-md-4 form-group">
                <label>Nom*</label>
                <input type="text" name="nom"  required class="form-control" id="nom" placeholder="Votre nom" minlength="2" data-msg="Entrer au moins 2 caracteres"
                value="{!! old('nom') !!}">
                <div class="validate"></div>
              </div>
              <div class="col-md-4 form-group">
                <label>Prénom*</label>
                <input type="text"  required class="form-control" name="prenom" id="prenom" placeholder="Votre prénom" minlength="2" data-msg="Entrer au moins 2 caracteres"
                value="{!! old('prenom') !!}">
                <div class="validate"></div>
              </div>
              <div class="col-md-4 form-group">
                <label>Sexe*</label>
                <select name="sexe" id="sexe" class="form-control" >
                  <option value="Masculin" {{ old('sexe') == "Masculin" ? "selected" : "" }}>Masculin</option>
                  <option value="Féminin" {{ old('sexe') == "Féminin" ? "selected" : "" }}>Féminin</option>
                </select>
                <div class="validate"></div>
              </div>
              <div class="col-md-4 form-group">
                <label>Téléphone</label>
                <input type="tel" class="form-control" name="telephone" id="telephone" placeholder="Votre numero de téléphone" minlength="8" data-msg="Entrer au moins 8 caracteres" 
                value="{!! old('telephone') !!}">
                <div class="validate"></div>
              </div>
              <div class="col-md-4 form-group">
                <label>Date de naissance*</label>
                <input type="datetime" required name="date_naissance" class="form-control datepicker" id="date_naissance" placeholder="Votre date de naissance" autocomplete="off" data-rule="minlen:4" data-msg="Respecter le format"
                value="{!! old('date_naissance') !!}">
                <div class="validate"></div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-4 form-group">
                <label>Département*</label>
                <select name="departement" id="departement" class="form-control" value="{!! old('departement') !!}">
                  <option value="Artibonite" {{ old('departement') == "Artibonite" ? "selected" : "" }}>Artibonite</option>
                  <option value="Centre" {{ old('departement') == "Centre" ? "selected" : "" }}>Centre</option>
                  <option value="Grand'Anse" {{ old('departement') == "Grand'Anse" ? "selected" : "" }}>Grand'Anse</option>
                  <option value="Nippes" {{ old('departement') == "Nippes" ? "selected" : "" }}>Nippes</option>
                  <option value="Nord" {{ old('departement') == "Nord" ? "selected" : "" }}>Nord</option>
                  <option value="Nord-Est" {{ old('departement') == "Nord-Est" ? "selected" : "" }}>Nord-Est</option>
                  <option value="Nord-Ouest" {{ old('departement') == "Nord-Ouest" ? "selected" : "" }}>Nord-Ouest</option>
                  <option value="Ouest" {{ old('departement') == "Ouest" ? "selected" : "" }}>Ouest</option>
                  <option value="Sud" {{ old('departement') == "Sud" ? "selected" : "" }}>Sud</option>
                  <option value="Sud-Est" {{ old('departement') == "Sud-Est" ? "selected" : "" }}>Sud-Est</option>
                </select>
                <div class="validate"></div>
              </div>
              <div class="col-md-4 form-group">
                <label>Commune*</label>
                <select name="commune" id="commune" class="form-control" value="{!! old('commune') !!}">
                  <option value="Port-au-Prince" {{ old('commune') == "Port-au-Prince" ? "selected" : "" }}>Port-au-Prince</option>
                  <option value="Carrefour" {{ old('commune') == "Carrefour" ? "selected" : "" }}>Carrefour</option>
                  <option value="Gressier" {{ old('commune') == "Gressier" ? "selected" : "" }}>Gressier</option>
                  <option value="Petit-Goave" {{ old('commune') == "Petit-Goave" ? "selected" : "" }}>Petit-Goave</option>
                  <option value="Léogane" {{ old('commune') == "Léogane" ? "selected" : "" }}>Léogane</option>
                  <option value="Grand-Goave" {{ old('commune') == "Grand-Goave" ? "selected" : "" }}>Grand-Goave</option>
                  <option value="Croix de Bouquets" {{ old('commune') == "Croix de Bouquets" ? "selected" : "" }}>Croix de Bouquets</option>
                  <option value="Tabarre" {{ old('commune') == "Tabarre" ? "selected" : "" }}>Tabarre</option>
                  <option value="Delmas" {{ old('commune') == "Delmas" ? "selected" : "" }}>Delmas</option>
                  <option value="Pétion-Ville" {{ old('commune') == "Pétion-Ville" ? "selected" : "" }}>Pétion-Ville</option>
                  <option value="Cité-Soleil" {{ old('commune') == "Cité-Soleil" ? "selected" : "" }}>Cité-Soleil</option>
                </select>
                <div class="validate"></div>
              </div>
              <div class="col-md-4 form-group">
                <label>Rue*</label>
                <input type="text" required name="rue" class="form-control" id="rue" placeholder="Nom de la rue de votre adresse" minlength="2" data-msg="Entrer au moins 2 caracteres"
                value="{!! old('rue') !!}">
                <div class="validate"></div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-6 form-group">
                <label>Raison de la réalisation du test*</label>
                <select name="raison_test" id="raison_test" class="form-control"   value="{!! old('raison_test') !!}">
                  <option value="Cas suspect"  {{ old('raison_test') == "Cas suspect" ? "selected" : "" }}>Cas suspect</option>
                  <option value="Cas contact"  {{ old('raison_test') == "Cas contact" ? "selected" : "" }}>Cas contact</option>
                  <option value="Voyage"  {{ old('raison_test') == "Voyage" ? "selected" : "" }}>Voyage</option>
                  <option value="Obligation de l'employeur"  {{ old('raison_test') == "Obligation de l'employeur" ? "selected" : "" }}>Obligation de l'employeur</option>
                  <option value="Autre"  {{ old('raison_test') == "Autre" ? "selected" : "" }}>Autre</option>
                </select>
                <div class="validate"></div>
              </div>
              <div class="col-md-6 form-group" id="div_date_voyage">
                <label>Date du voyage</label>
                <input type="datetime"  name="date_voyage" class="form-control datepicker" id="date_voyage" placeholder="La date du voyage" autocomplete="off" data-rule="minlen:4" data-msg="Respecter le format"               
                  value="{!! old('date_voyage') !!}"
                  >
                <div class="validate"></div>
              </div>
            </div>
            @isset($date_rendez_vous)
              <input type="hidden" name="date_rendez_vous"  value="{{$date_rendez_vous->format('d M Y') }}"  id="date_rendez_vous" >
              
            @endisset
           
  
           
            {{-- <div class="mb-3">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your appointment request has been sent successfully. Thank you!</div>
            </div> --}}
            <div class="form-row">
              <div class="col-md-offset-2 col-md-4 form-group">
               <div class="text-center"><button type="submit" name="submit" value="patient_demande_une_autre_date" class="btn btn-primary">Proposition d'une date de rendez-vous</button></div>
              </div>
              @isset($date_rendez_vous)
              <div class="text-center"><button type="submit" name="submit" value="patient_accepte_la_date" class="btn btn-primary">Soumettre</button></div>
              @endisset
            </div>
          </form>
  
        </div>
      </section><!-- End Appointment Section -->
</div>

@push('scripts')
<script type="text/javascript">
 $(function () {
  $("#div_date_voyage").hide();//par defaut on cache la date du voyage
 if( $('#raison_test :selected').text() =='Voyage')
 {
  $("#div_date_voyage").show();
 }
  $("#raison_test").change(function() {
    var val = $(this).val();
    if(val === "Voyage") {
        $("#div_date_voyage").show();
    }
    else  {
        $("#div_date_voyage").hide();
    }
  });
});
  </script>
@endpush
@endsection
