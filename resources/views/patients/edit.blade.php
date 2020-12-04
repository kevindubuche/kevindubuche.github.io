@extends('main')


@section('listeDesHospitaux') 
<div class="container" style="margin-top: 150px">
@include('flashmessage')
          <!-- ======= Appointment Section ======= -->
          <section id="appointment" class="appointment section-bg">
            <div class="container">
      
              <div class="section-title">
                <h2>Modifier un hopital</h2>
                <p>Remplissez le formulaire suivant pour creer un hospital. Noter que les tous champs sont obligatoires.</p>
              </div>
      
              <form action="{{ route('hospital.update',$hospital->id) }}" method="post" role="form" >
                @csrf
                @method('PATCH')
                <input type="hidden" value="{{$hospital->id}}" >
                <div class="form-row">
                  <div class="col-md-4 form-group">
                    <label>Nom de l'hopital*</label>
                    <input type="text" name="nom" value="{{$hospital->nom}}" required class="form-control" id="nom" placeholder="Le nom de l'hopital" minlength="2" data-msg="Entrer au moins 2 caracteres">
                    <div class="validate"></div>
                  </div>
                  <div class="col-md-4 form-group">
                    <label>Adresse de l'hopital*</label>
                    <input type="text"  required class="form-control" value="{{$hospital->adresse}}" name="adresse" id="adresse" placeholder="L'adresse de l'hopital" minlength="2" data-msg="Entrer au moins 2 caracteres">
                    <div class="validate"></div>
                  </div>
                  <div class="col-md-4 form-group">
                    <label>Maximum visiyeurs par jour*</label>
                    <input type="number" required class="form-control" value="{{$hospital->maximum_visites_par_jour}}" name="maximum_visites_par_jour" id="maximum_visites_par_jour" placeholder="Maximum visiyeurs par jour" minlength="8" data-msg="Entrer au moins 8 caracteres">
                    <div class="validate"></div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-4 form-group">
                    <label>Département*</label>
                    <select name="departement" id="departement" class="form-control">
                      <option value="Artibonite" {{$hospital->departement == 'Artibonite'? 'selected' : ''}}>Artibonite</option>
                      <option value="Centre" {{$hospital->departement == 'Centre'? 'selected' : ''}}>Centre</option>
                      <option value="Grand'Anse" {{$hospital->departement == 'Grand\'Anse'? 'selected' : ''}}>Grand'Anse</option>
                      <option value="Nippes" {{$hospital->departement == 'Nippes'? 'selected' : ''}}>Nippes</option>
                      <option value="Nord" {{$hospital->departement == 'Nord'? 'selected' : ''}}>Nord</option>
                      <option value="Nord-Est" {{$hospital->departement == 'Nord-Est'? 'selected' : ''}}>Nord-Est</option>
                      <option value="Nord-Ouest" {{$hospital->departement == 'Nord-Ouest'? 'selected' : ''}}>Nord-Ouest</option>
                      <option value="Ouest" {{$hospital->departement == 'Ouest'? 'selected' : ''}}>Ouest</option>
                      <option value="Sud" {{$hospital->departement == 'Sud'? 'selected' : ''}}>Sud</option>
                      <option value="Sud-Est" {{$hospital->departement == 'Sud-Est'? 'selected' : ''}}>Sud-Est</option>
                    </select>
                    <div class="validate"></div>
                  </div>
                  <div class="col-md-4 form-group">
                    <label>Commune*</label>
                    <select name="commune" id="commune" class="form-control">
                      <option value="Port-au-Prince" {{$hospital->commune == 'Port-au-Prince'? 'selected' : ''}}>Port-au-Prince</option>
                      <option value="Carrefour" {{$hospital->commune == 'Carrefour'? 'selected' : ''}}>Carrefour</option>
                      <option value="Gressier" {{$hospital->commune == 'Gressier'? 'selected' : ''}}>Gressier</option>
                      <option value="Petit-Goave" {{$hospital->commune == 'Petit-Goave'? 'selected' : ''}}>Petit-Goave</option>
                      <option value="Léogane" {{$hospital->commune == 'Léogane'? 'selected' : ''}}>Léogane</option>
                      <option value="Grand-Goave" {{$hospital->commune == 'Grand-Goave'? 'selected' : ''}}>Grand-Goave</option>
                      <option value="Croix de Bouquets" {{$hospital->commune == 'Croix de Bouquets'? 'selected' : ''}}>Croix de Bouquets</option>
                      <option value="Tabarre" {{$hospital->commune == 'Tabarre'? 'selected' : ''}}>Tabarre</option>
                      <option value="Delmas" {{$hospital->commune == 'Delmas'? 'selected' : ''}}>Delmas</option>
                      <option value="Pétion-Ville" {{$hospital->commune == 'Pétion-Ville'? 'selected' : ''}}>Pétion-Ville</option>
                      <option value="Cité-Soleil" {{$hospital->commune == 'Cité-Soleil'? 'selected' : ''}}>Cité-Soleil</option>
                    </select>
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
                              <tr>
                                <td><input type="checkbox" name="multiclass[]" value="Port-au-Prince"
                                  @foreach ($anciennesAssignations as $assig)
                                    @if($assig->commune == "Port-au-Prince")
                                    checked
                                    @endif
                                  @endforeach  ></td>
                                <td>Port-au-Prince</td>
                              </tr>
                              <tr>
                                <td><input type="checkbox" name="multiclass[]" value="Carrefour"
                                  @foreach ($anciennesAssignations as $assig)
                                    @if($assig->commune == "Carrefour")
                                    checked
                                    @endif
                                  @endforeach   ></td>
                                <td>Carrefour</td>
                              </tr>
                              <tr>
                                <td><input type="checkbox" name="multiclass[]" value="Gressier" 
                                  @foreach ($anciennesAssignations as $assig)
                                    @if($assig->commune == "Gressier")
                                    checked
                                    @endif
                                  @endforeach  ></td>
                                <td>Gressier</td>
                              </tr>
                              <tr>
                                <td><input type="checkbox" name="multiclass[]" value="Petit-Goave" 
                                  @foreach ($anciennesAssignations as $assig)
                                    @if($assig->commune == "Petit-Goave")
                                    checked
                                    @endif
                                  @endforeach  ></td>
                                <td>Petit-Goave</td>
                              </tr>
                              <tr>
                                <td><input type="checkbox" name="multiclass[]" value="Léogane" 
                                  @foreach ($anciennesAssignations as $assig)
                                    @if($assig->commune == "Léogane")
                                    checked
                                    @endif
                                  @endforeach  ></td>
                                <td>Léogane</td>
                              </tr>
                              <tr>
                                <td><input type="checkbox" name="multiclass[]" value="Grand-Goave"
                                  @foreach ($anciennesAssignations as $assig)
                                    @if($assig->commune == "Grand-Goave")
                                    checked
                                    @endif
                                  @endforeach   ></td>
                                <td>Grand-Goave</td>
                              </tr>
                              <tr>
                                <td><input type="checkbox" name="multiclass[]" value="Croix de Bouquets"
                                  @foreach ($anciennesAssignations as $assig)
                                    @if($assig->commune == "Croix de Bouquets")
                                    checked
                                    @endif
                                  @endforeach   ></td>
                                <td>Croix de Bouquets</td>
                              </tr>
                              <tr>
                                <td><input type="checkbox" name="multiclass[]" value="Tabarre" 
                                  @foreach ($anciennesAssignations as $assig)
                                    @if($assig->commune == "Tabarre")
                                    checked
                                    @endif
                                  @endforeach  ></td>
                                <td>Tabarre</td>
                              </tr>
                              <tr>
                                <td><input type="checkbox" name="multiclass[]" value="Delmas"
                                  @foreach ($anciennesAssignations as $assig)
                                    @if($assig->commune == "Delmas")
                                    checked
                                    @endif
                                  @endforeach   ></td>
                                <td>Delmas</td>
                              </tr>
                              <tr>
                                <td><input type="checkbox" name="multiclass[]" value="Pétion-Ville" 
                                  @foreach ($anciennesAssignations as $assig)
                                    @if($assig->commune == "Pétion-Ville")
                                    checked
                                    @endif
                                  @endforeach  ></td>
                                <td>Pétion-Ville</td>
                              </tr>
                              <tr>
                                <td><input type="checkbox" name="multiclass[]" value="Cité-Soleil" 
                                  @foreach ($anciennesAssignations as $assig)
                                    @if($assig->commune == "Cité-Soleil")
                                    checked
                                    @endif
                                  @endforeach  ></td>
                                <td>Cité-Soleil</td>
                              </tr>
                        </tbody>
                    </table> 
                </div>
                </div>
           
                <div class="text-center"><button type="submit" class="btn btn-primary">Soumettre</button></div>
              </form>
      
            </div>
          </section><!-- End Appointment Section -->
</div>
@endsection
