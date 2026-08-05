@if( $infolettre->isNotEmpty() )

<table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>N°</th>
        <th>Adresse Email</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    
    <?php $i = 1; ?>
    @foreach( $infolettre as $in )
    <tr>
      <td>{{ $i++ }}</td>
      <td>{{ $in->email }}</td>
      <td>
        <a href="javascript();" data-toggle="modal" data-target="#del_mail" data-id="{{ $in->id }}" class="btn btn-danger btn-sm" title="Supprimer"> <i class="fas fa-trash"></i></a>
      </td>
    </tr>
    @endforeach

    
  </tbody>
</table>
@else
<p>
  Pas de Email disponible en ce moment!
</p>
@endif