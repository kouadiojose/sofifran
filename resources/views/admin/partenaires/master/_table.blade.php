@if( $partenaire->isNotEmpty() )

<table id="example1" class="table table-bordered table-striped">

    <thead>

      <tr>

        <th>N°</th>

        <th>Image</th>

        <th>Nom</th>

        <th>Lien</th>

        <th>Type de partenaire</th>

        <th>Action</th>

      </tr>

    </thead>

    <tbody>

    

    <?php $i = 1; ?>

    @foreach( $partenaire as $p )

    <tr>

      <td>{{ $i++ }}</td>

      <td><img src="/frontend/assets/images/partenaires/{{ $p->image }}" width="50">

      </td> 

      <td>{{ $p->name }}

      </td> 

      <td>{{ $p->link }}

      </td> 

      <td> <?= ucfirst($p->type); ?>

      </td> 

      <td>

        <a href="{{ route('admin-partenaire-edit', $p->id) }}" class="btn btn-info btn-sm" title="Modifier"> <i class="fas fa-pencil-alt"></i></a>

        <a href="javascript();" data-toggle="modal" data-target="#del_partenaire" data-id="{{ $p->id }}" class="btn btn-danger btn-sm" title="Supprimer"> <i class="fas fa-trash"></i></a>

      </td>

    </tr>

    @endforeach

  </tbody>

</table>

@else

<p>

  Pas de partenaire disponible en ce moment!

</p>

@endif