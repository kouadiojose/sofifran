@if( $galerie->isNotEmpty() )

<table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>N°</th>
        <th>Photo</th>
        <th>Activité liée</th>
        <th>Date d'ajout</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

    <?php $i = 1; ?>
    @foreach( $galerie as $p )
    <tr>
      <td>{{ $i++ }}</td>
      <td><img src="/frontend/assets/images/gallery/photos/{{ $p->image }}" width="100" alt="Photo de galerie"></td>
      <td>{{ $p->titre }}</td>
      <td>{{ $p->created_at ? date('d/m/Y', strtotime($p->created_at)) : '-' }}</td>

      <td width="100" align="center">
        <a href="{{ route('admin-galerie-edit', $p->id) }}" class="btn btn-info btn-sm" title="Modifier"> <i class="fas fa-pencil-alt"></i></a>
        <a href="javascript:;" data-toggle="modal" data-target="#del_galerie" data-id="{{ $p->id }}" class="btn btn-danger btn-sm" title="Supprimer"> <i class="fas fa-trash"></i></a>
      </td>
    </tr>
    @endforeach

  </tbody>
</table>
@else
<p>
  Pas de photo disponible en ce moment! Utilisez le bouton "Créer un nouveau" pour ajouter des photos à une activité.
</p>
@endif
