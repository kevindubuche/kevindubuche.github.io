@extends('main')


@section('listeDesHospitaux') 
<div class="container" style="margin-top: 150px">
  <div class="table-responsive">
      <h2>Liste des hôpitaux   <a class="btn btn-primary pull-right"  href="{{ route('hospital.create') }}" >Ajouter hôpital</a>
      </h2>
    <table id='myTable' class=' display   table table-bordered table-striped table-condensed'>
       
        <thead>
            <tr>
                <th>Nom</th>
                <th>Code</th>
                <th>Commune</th>
                <th>Departement</th>
                <th>Adresse</th>
                <th>Max visite/jour</th>
                <th>Date de création</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($hospitaux as $hospital)
            <tr>
                <td>{{ $hospital->nom }}</td>
                <td>{{ $hospital->code_hospital }}</td>
                <td>{{ $hospital->commune }}</td>
                <td>{{ $hospital->departement }}</td>
                <td>{{ $hospital->adresse }}</td>
                <td>{{ $hospital->maximum_visites_par_jour }}</td>
                <td>{{ $hospital->created_at->format('d M Y') }}</td>
                <td>
                    <div class='btn-group'>
                        <a href="{{ route('hospital.show', [$hospital->id]) }}"  class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('hospital.edit', [$hospital->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                         <form action="{{ route('hospital.destroy', $hospital->id)}}" method="post">
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
