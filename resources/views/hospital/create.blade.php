@extends('main')


@section('listeDesHospitaux') 
<div class="container" style="margin-top: 150px">

          <!-- ======= Appointment Section ======= -->
          <section id="appointment" class="appointment section-bg">
            <div class="container">
      
              <div class="section-title">
                <h2>Ajouter un hopital</h2>
                <p>Remplissez le formulaire suivant pour creer un hospital. Noter que les tous champs sont obligatoires.</p>
              </div>
      
              <form action="{{ route('hospital.store') }}" method="post" role="form" >
                @csrf
                <div class="form-row">
                  <div class="col-md-4 form-group">
                    <label>Nom de l'hopital*</label>
                    <input type="text" name="nom"  required class="form-control" id="nom" placeholder="Le nom de l'hopital" minlength="2" data-msg="Entrer au moins 2 caracteres">
                    <div class="validate"></div>
                  </div>
                  <div class="col-md-4 form-group">
                    <label>Adresse de l'hopital*</label>
                    <input type="text"  required class="form-control" name="adresse" id="adresse" placeholder="L'adresse de l'hopital" minlength="2" data-msg="Entrer au moins 2 caracteres">
                    <div class="validate"></div>
                  </div>
                  <div class="col-md-4 form-group">
                    <label>Maximum visiyeurs par jour*</label>
                    <input type="number" class="form-control" required name="maximum_visites_par_jour" id="maximum_visites_par_jour" placeholder="Maximum visiyeurs par jour" minlength="8" data-msg="Entrer au moins 8 caracteres">
                    <div class="validate"></div>
                  </div>
                </div>
              

              <div class="form-row">
                <div class="col-md-4 form-group">
                  <label>Code hopital*</label>
                  <input type="text" class="form-control" required name="code_hospital" id="code_hospital" placeholder="Code de l'hopital" minlength="2" data-msg="Entrer au moins 2 caracteres">
                  <div class="validate"></div>
                </div>
               </div>

                <div class="form-row">
                  <div class="col-md-4 form-group">
                    <label>Département*</label>
                    <select name="departement" id="departement" class="form-control">
                      <option value="Artibonite">Artibonite</option>
                      <option value="Centre">Centre</option>
                      <option value="Grand'Anse">Grand'Anse</option>
                      <option value="Nippes">Nippes</option>
                      <option value="Nord">Nord</option>
                      <option value="Nord-Est">Nord-Est</option>
                      <option value="Nord-Ouest">Nord-Ouest</option>
                      <option value="Ouest">Ouest</option>
                      <option value="Sud">Sud</option>
                      <option value="Sud-Est">Sud-Est</option>
                    </select>
                    <div class="validate"></div>
                  </div>
                  <div class="col-md-4 form-group">
                    <label>Commune*</label>
                    <select name="commune" id="commune" class="form-control">
                      <option value="Port-au-Prince">Port-au-Prince</option>
                      <option value="Carrefour">Carrefour</option>
                      <option value="Gressier">Gressier</option>
                      <option value="Petit-Goave">Petit-Goave</option>
                      <option value="Léogane">Léogane</option>
                      <option value="Grand-Goave">Grand-Goave</option>
                      <option value="Croix de Bouquets">Croix de Bouquets</option>
                      <option value="Tabarre">Tabarre</option>
                      <option value="Delmas">Delmas</option>
                      <option value="Pétion-Ville">Pétion-Ville</option>
                      <option value="Cité-Soleil">Cité-Soleil</option>
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
                                <td><input type="checkbox" name="multiclass[]" value="Port-au-Prince" ></td>
                                <td>Port-au-Prince</td>
                              </tr>
                              <tr>
                                <td><input type="checkbox" name="multiclass[]" value="Carrefour" ></td>
                                <td>Carrefour</td>
                              </tr>
                              <tr>
                                <td><input type="checkbox" name="multiclass[]" value="Gressier" ></td>
                                <td>Gressier</td>
                              </tr>
                              <tr>
                                <td><input type="checkbox" name="multiclass[]" value="Petit-Goave" ></td>
                                <td>Petit-Goave</td>
                              </tr>
                              <tr>
                                <td><input type="checkbox" name="multiclass[]" value="Léogane" ></td>
                                <td>Léogane</td>
                              </tr>
                              <tr>
                                <td><input type="checkbox" name="multiclass[]" value="Grand-Goave" ></td>
                                <td>Grand-Goave</td>
                              </tr>
                              <tr>
                                <td><input type="checkbox" name="multiclass[]" value="Croix de Bouquets" ></td>
                                <td>Croix de Bouquets</td>
                              </tr>
                              <tr>
                                <td><input type="checkbox" name="multiclass[]" value="Tabarre" ></td>
                                <td>Tabarre</td>
                              </tr>
                              <tr>
                                <td><input type="checkbox" name="multiclass[]" value="Delmas" ></td>
                                <td>Delmas</td>
                              </tr>
                              <tr>
                                <td><input type="checkbox" name="multiclass[]" value="Pétion-Ville" ></td>
                                <td>Pétion-Ville</td>
                              </tr>
                              <tr>
                                <td><input type="checkbox" name="multiclass[]" value="Cité-Soleil" ></td>
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
