@if( $galerie->isNotEmpty() )



<table id="example1" class="table table-bordered table-striped">

    <thead>

      <tr>

        <th>N°</th>

        <th>Image</th>

        <th>Titre en Francais</th>

        <th>Titre en Anglais</th>
        <th>Type activité </th>

        <th>Action</th>

      </tr>

    </thead>

    <tbody>

    

    <?php $i = 1; ?>

    @foreach( $galerie as $p )

    <tr>

      <td align="center">{{ $i++ }}</td>

      <td align="center"><img src="/frontend/assets/images/activites/{{ $p->image }}" width="80"></td>

      <td align="center">{{ $p->title_fr }}</td>

      <td align="center">{{ $p->title_en }}</td>
      <td align="center"><?= ucfirst($p->categorie_activity_slug); ?></td>

      <td width="100" align="center">

        <a href="{{ route('admin-activite-edit', $p->id) }}" class="btn btn-info btn-sm" title="Modifier"> <i class="fas fa-pencil-alt"></i></a>

        <a href="javascript();" data-toggle="modal" data-target="#del_galerie" data-id="{{ $p->id }}" class="btn btn-danger btn-sm" title="Supprimer"> <i class="fas fa-trash"></i></a>

      </td>

    </tr>

    @endforeach





  </tbody>

</table>    

@else

<p>

  Pas d'activite disponible en ce moment!

</p>

@endif