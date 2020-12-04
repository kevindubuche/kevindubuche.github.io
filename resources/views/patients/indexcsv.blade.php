@extends('main')


@section('listeDesPatients') 
<div class="container" style="margin-top: 150px">
@include('flashmessage')

  <div class="table-responsive" style="margin-top: 50px">
      
      <h2>Liste des patients</h2>
              
        <form action="{{ route('download-csv-patients')}}" method="post" class="row" style="margin-top: 50px">
            @csrf
            <div class="col-md-12 form-group" style="margin-top: 50px" >
            
              <table  >
                  <thead >
                      <tr>
                        <td></td>
                  <label>Filtrage:</label>
                      </tr>
                  </thead>
                  <tbody>
                        <tr>
                            <td>Hopital</td>
                            <td>
                                <select class="form-control" name="hospital" id="hospital" >
                                <option  value="Tous"
                                @isset($inputs['hospital'])
                                    @if($inputs['hospital'] == "Tous")
                                    selected
                                    @endif
                                @endisset>Tous</option>
                                @foreach($allHospital as $hosto)
                                <option value="{{$hosto->id}}" 
                                    @isset($inputs['hospital'])
                                    @if($inputs['hospital'] == $hosto->id)
                                    selected
                                    @endif
                                @endisset >{{$hosto->nom}}</option>
                                @endforeach
                            </select>
                            </td>
                            <td>Sexe</td>
                            <td>
                                <select class="form-control" name="sexe" id="sexe" >
                                    <option  value="Tous"
                                    @isset($inputs['sexe'])
                                    @if($inputs['sexe'] == "Tous")
                                    selected
                                    @endif
                                @endisset>Tous</option>
                                    <option value="Masculin"
                                    @isset($inputs['sexe'])
                                    @if($inputs['sexe'] == "Masculin")
                                    selected
                                    @endif
                                @endisset>Masculin</option>
                                    <option value="Féminin"
                                    @isset($inputs['sexe'])
                                    @if($inputs['sexe'] == "Féminin")
                                    selected
                                    @endif
                                @endisset>Féminin</option>                  
                            </select>
                            </td>
                            <td>Raison</td>
                            <td>
                                <select class="form-control" name="raison_test" id="raison_test" >
                                    <option  value="Tous" 
                                    @isset($inputs['raison_test'])
                                        @if($inputs['raison_test'] == "Tous")
                                        selected
                                        @endif
                                    @endisset>Tous</option>
                                    <option value="Cas suspect"
                                    @isset($inputs['raison_test'])
                                        @if($inputs['raison_test'] == "Cas suspect")
                                        selected
                                        @endif
                                    @endisset>Cas suspect</option>
                                    <option value="Cas contact" 
                                    @isset($inputs['raison_test'])
                                        @if($inputs['raison_test'] == "Cas contact")
                                        selected
                                        @endif
                                    @endisset>Cas contact</option>
                                    <option value="Voyage" 
                                    @isset($inputs['raison_test'])
                                        @if($inputs['raison_test'] == "Voyage")
                                        selected
                                        @endif
                                    @endisset>Voyage</option>
                                    <option value="Obligation de l'employeur"
                                    @isset($inputs['raison_test'])
                                        @if($inputs['raison_test'] == "Obligation de l'employeur")
                                        selected
                                        @endif
                                    @endisset>Obligation de l'employeur</option>
                                    <option value="Autre"
                                    @isset($inputs['raison_test'])
                                        @if($inputs['raison_test'] == "Autre")
                                        selected
                                        @endif
                                    @endisset>Autre</option>
                                                
                            </select>
                            </td>
                        </tr>
                            <td>Rendez-vous du</td>
                            <td><input type="datetime"  name="date_rendez_vous_debut" 
                                @isset($inputs['date_rendez_vous_debut'])
                            value="{{$inputs['date_rendez_vous_debut']}}"
                                  @endisset
                                class="form-control datepicker" id="date_rendez_vous_debut" placeholder="Votre date de rendez-vous" autocomplete="off"></td>
                            <td>Au</td>
                            <td> <input type="datetime"  name="date_rendez_vous_fin" 
                                @isset($inputs['date_rendez_vous_fin'])
                                value="{{$inputs['date_rendez_vous_fin']}}"
                                      @endisset
                                class=" form-control datepicker" id="date_rendez_vous_fin" placeholder="Votre date de rendez-vous" autocomplete="off"></td>
                            
                            <td>Cree du</td>
                            <td><input type="datetime"  name="created_at_debut" 
                                @isset($inputs['created_at_debut'])
                                value="{{$inputs['created_at_debut']}}"
                                  @endisset
                                      class="form-control datepicker" id="created_at_debut" placeholder="Date de creation" autocomplete="off"></td>
                            <td>Au</td>
                            <td> <input type="datetime"  name="created_at_fin" 
                                @isset($inputs['created_at_fin'])
                                value="{{$inputs['created_at_fin']}}"
                                  @endisset
                                  class=" form-control datepicker" id="created_at_fin" placeholder="Date de creation" autocomplete="off"></td>
                            
                        </tr>
                      
                    
                  </tbody>
              </table> 
          </div>
            {{-- Bouton PDF --}}
          <div class="btn btn-group" style=" float:left; margin-right:25px">
            <button type="submit" name="submit" value="download" class="btn btn-sm btn-success"><i class="fa fa-file-excel-o"></i> Télécharger</button>

            <button type="submit" name="submit" value="reload" class="btn btn-sm btn-warning"><i class="fa fa-refresh" style="color:white"></i></button>
        </div>
        </form>

        
        {{-- Fin Bouton PDF --}}
    <table id='myTable' class=' display   table table-bordered table-striped table-condensed'>
       
        <thead>
            <tr>
                <th>ID patient</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Sexe</th>
                <th>Adresse</th>
                <th>Téléphone</th>
                <th>Raison</th>
                <th>Date de rendez-vous</th>
                <th>Hôpital</th>
                <th>Date de création</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($patients as $patient)
            <tr>
                <td>{{ $patient->Hospital->code_hospital }}-{{ $patient->id }}</td>
                <td>{{ $patient->nom }}</td>
                <td>{{ $patient->prenom }}</td>
                <td>{{ $patient->sexe }}</td>
                <td>{{ $patient->departement }}, {{ $patient->commune }}, {{ $patient->rue }}</td>
                <td>{{ $patient->telephone }}</td>
                <td>{{ $patient->raison_test }}
                @if( $patient->raison_test =='Voyage')
                    @isset($patient->date_voyage)
                    ({{$patient->date_voyage->format('d M Y')}})
                    @endif
                @endif
                </td>
                <td>{{ $patient->date_rendez_vous }}</td>
                <td>{{ $patient->Hospital->nom }}</td>
                <td>{{ $patient->created_at->format('d M Y') }}</td>
                <td>
                   <div class='btn-group'>
                  
                        <a href="{{ route('patients.show', [$patient->id]) }}"  class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                       <form action="{{ route('patients.destroy', $patient->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <input type="submit" class=" btn btn-danger btn-xs" value="Delete" onclick="return confirm('Confirmer suppression');" />
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


</div>


</div>

@push('scripts')
<script>
    $(document).ready(function()
    {
        
        $('#myTable').DataTable({  
            // alert('okokok');
            select:true,
            "language": {
            "lengthMenu": "Voir _MENU_ lignes par page",
            "zeroRecords": "Aucune information",
            "info": "_PAGE_ sur _PAGES_",
            "infoEmpty": "Aucun résultat trouvé",
            "infoFiltered": "(filtre de _MAX_ total résultats)",
            "search": "Rechercher",
            "paginate":{
            "previous":"Précedent",
            "next":"Suivant"
            }


        },
        buttons:['selectRows']
    }

        );
    });
</script>
@endpush
@endsection
