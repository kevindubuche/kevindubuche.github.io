@extends('main')


@section('listeDesAddmins') 
<div class="container" style="margin-top: 150px">
@include('flashmessage')
  <div class="table-responsive">
      <h2>Liste des administrateurs   <a class="btn btn-primary pull-right"  href="{{ route('register') }}" >Ajouter administrateur</a>
      </h2>
    <table id='' class=' display   table table-bordered table-striped table-condensed'>
       
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Date de création</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($admins as $admin)
            <tr>
                <td>{{ $admin->id }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->created_at->format('d M Y') }}</td>
                <td>
                    <div class='btn-group'>
                       <form action="{{ route('admin.destroy', $admin->id)}}" method="post">
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
