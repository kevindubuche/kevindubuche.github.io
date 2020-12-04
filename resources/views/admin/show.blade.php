@extends('main')


@section('listeDesHospitaux') 
<div class="container" style="margin-top: 150px">
@include('flashmessage')
          <!-- ======= Appointment Section ======= -->
          <section id="appointment" class="appointment section-bg">
            <div class="container">
      
              <div class="section-title">
                <h2>Informations sur un hopital</h2>
                <p>Remplissez le formulaire suivant pour creer un hospital. Noter que les tous champs sont obligatoires.</p>
              </div>
      
              <form  >
                @csrf
                @method('PATCH')
                <input type="hidden" value="{{$hospital->id}}" >
                <div class="form-row">
                  <div class="col-md-4 form-group">
                    <label>Nom de l'hopital*</label>
                    <input type="text" name="nom" value="{{$hospital->nom}}" disabled  required class="form-control" id="nom" placeholder="Le nom de l'hopital" minlength="2" data-msg="Entrer au moins 2 caracteres">
                    <div class="validate"></div>
                  </div>
                  <div class="col-md-4 form-group">
                    <label>Adresse de l'hopital*</label>
                    <input type="text"  required class="form-control" value="{{$hospital->adresse}}" disabled  name="adresse" id="adresse" placeholder="L'adresse de l'hopital" minlength="2" data-msg="Entrer au moins 2 caracteres">
                    <div class="validate"></div>
                  </div>
                  <div class="col-md-4 form-group">
                    <label>Maximum visiyeurs par jour*</label>
                    <input type="number" class="form-control" value="{{$hospital->maximum_visites_par_jour}}" disabled  name="maximum_visites_par_jour" id="maximum_visites_par_jour" placeholder="Maximum visiyeurs par jour" minlength="8" data-msg="Entrer au moins 8 caracteres">
                    <div class="validate"></div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-4 form-group">
                    <label>Département*</label> 
                    <input type="text" class="form-control" value="{{$hospital->departement}}" disabled  name="departement" id="departement" placeholder="Departement" minlength="8" data-msg="Entrer au moins 8 caracteres">
                    <div class="validate"></div>
                  </div>
                  <div class="col-md-4 form-group">
                    <label>Commune*</label>
                    <input type="text" class="form-control" value="{{$hospital->commune}}" disabled  name="commune" id="commune" placeholder="Commune" minlength="8" data-msg="Entrer au moins 8 caracteres">
                    <div class="validate"></div>
                  </div>
                  <div class="col-md-4 form-group">
                    <label>Date de creation*</label>
                    <input type="text" class="form-control" value="{{$hospital->created_at}}" disabled  name="created_at" id="created_at" placeholder="Date de creation" minlength="8" data-msg="Entrer au moins 8 caracteres">
                    <div class="validate"></div>
                  </div>
                  
                  <div class="col-md-4 form-group" style="height:224px;
                  overflow:auto;">
                    <table  >
                        <thead>
                            <tr>
                              <td></td>
                        <label>Point de rendez-vous pour les patients de :</label>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($assignations as $assig)
                              <tr>
                              <td><input type="checkbox" name="multiclass[]" value="{{$assig->commune }}"
                                    checked
                                    disabled
                                  ></td>
                                <td>{{$assig->commune}}</td>
                              </tr>
                          @endforeach 
                        </tbody>
                    </table> 
                </div>
                </div>
              </form>
      
            </div>
          </section><!-- End Appointment Section -->
</div>
@endsection
