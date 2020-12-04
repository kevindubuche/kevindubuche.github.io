@extends('main')


@section('listeDesPatients') 
<div class="container" style="margin-top: 150px">
@include('flashmessage')

  <div class="table-responsive">
      <h2>Liste des patients</h2>
          {{-- Bouton PDF --}}
          <div class="btn btn-group" style="margin-top:20px, float:left; margin-right:25px">
            <button type="button" class="btn btn-sm btn-success"><i class="fa fa-file-excel-o" style="color:white"></i> 
                <a href="{{route('patientscsv')}}" class="btn btn">Télécharger CSV</a>
            </button>
            
        </div>
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
