<table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>N°</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    @if( $users->isNotEmpty() )
    <?php $i = 1; ?>
    @foreach( $users as $u )

    
    <tr>
      <td>{{ $i++ }}</td>
      
      <td>{{ $u->name }}</td>
      <td>{{ $u->email }}</td>
      <td>{{ $u->role_name }}</td>
      <td width="" align="center">
        <a href="{{ route('admin-edit-user', $u->id) }}" class="btn btn-info btn-sm" title="Modifier"> <i class="fas fa-pencil-alt"></i></a>
        <a href="javascript();" data-toggle="modal" data-target="#del_user" data-id="{{ $u->id }}" class="btn btn-danger btn-sm" title="Supprimer"> <i class="fas fa-trash"></i></a>
      </td>
    </tr>
    @endforeach

    @else
    <p>
      Pas de Users disponible en ce moment!
    </p>
    @endif
  </tbody>
</table>