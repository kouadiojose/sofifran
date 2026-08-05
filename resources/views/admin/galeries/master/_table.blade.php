@if( $galerie->isNotEmpty() )



<table id="example1" class="table table-bordered table-striped">

    <thead>

      <tr>

        <th>N°</th>

        <th>Image</th>

        <th>Activité</th>
        <th>Action</th>

      </tr>

    </thead>

    <tbody>

    

    <?php $i = 1; ?>

    @foreach( $galerie as $p )
    <tr>
      <td>{{ $i++ }}</td>
      <td><img src="/frontend/assets/images/activites/{{ $p->img_activite }}" width="80"></td>
      <td>{{ $p->titre }}</td>

      <td width="100" align="center">
        <a href="{{ route('admin-galerie-edit', $p->id) }}" class="btn btn-info btn-sm" title="Modifier"> <i class="fas fa-pencil-alt"></i></a>
        <a href="javascript();" data-toggle="modal" data-target="#del_galerie" data-id="{{ $p->id }}" class="btn btn-danger btn-sm" title="Supprimer"> <i class="fas fa-trash"></i></a>
      </td>
    </tr>

    @endforeach





  </tbody>

</table>    

@else

<p>

  Pas de blog disponible en ce moment!

</p>

@endif