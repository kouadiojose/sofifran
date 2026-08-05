@if( $post->isNotEmpty() )
<table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>N°</th>
        <th>Image du projet</th>
        <th>Titre Français</th>
        <th>Titre Anglais</th>
        <th>Statut</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    
    <?php $i = 1; ?>
    @foreach( $post as $p )

    <?php 
        $don = DB::table('donates')->where('projet_id', $p->id)
        ->get();
        $total = 0;

        foreach ($don as $key => $value) {
          # code...
          $total = $total + $value->gains;
        }
     ?>
    <tr>
      <td class="text-center">{{ $i++ }}</td>
      <td class="text-center"><img src="/frontend/assets/images/projects/{{ $p->image }}" width="50"></td>
      <td class="text-center"><a href="{{ route('admin-projet-view', $p->id) }}">{{ $p->titre_fr }}</a>
      </td class="text-center"> 
      <td class="text-center"><a href="{{ route('admin-projet-view', $p->id) }}">{{ $p->titre_en }}</a>
      </td> 
      
      <td class="text-center">
        @if( $p->ended == 'no' )
          <span class="badge badge-success">En cours</span>
        @else
          <span class="badge badge-danger">Terminé</span>
        @endif
      </td>

      <td width="200" align="center">
        <a href="{{ route('admin-projet-view', $p->id) }}" class="btn btn-secondary btn-sm" title="Voir les détails"> <i class="fas fa-eye"></i></a>
        <a href="{{ route('admin-projet-edit', $p->id) }}" class="btn btn-info btn-sm" title="Modifier"> <i class="fas fa-pencil-alt"></i></a>
        <a href="javascript();" data-toggle="modal" data-target="#del_project" data-id="{{ $p->id }}" class="btn btn-danger btn-sm" title="Supprimer"> <i class="fas fa-trash"></i></a>
      </td>
    </tr>
    @endforeach

   
  </tbody>
</table> 
@else
<div class="alert alert-info alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <h5><i class="icon fas fa-info"></i> Info!</h5>
  Vous n'avez pas encore ajouté de projet.
</div>
@endif