@if( $blog->isNotEmpty() )

<table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>N°</th>
        <th>Image</th>
        <th>Titre Français</th>
        <th>Titre Anglais</th>
        <th>Description Français</th>
        <th>Description Anglais</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    
    <?php $i = 1; ?>
    @foreach( $blog as $p )
    <tr>
      <td>{{ $i++ }}</td>
      <td><img src="/frontend/assets/images/blog/{{ $p->image }}" width="100"></td>
      <td>{{ $p->title_fr }}
      </td> 
      <td>{{ $p->title_en }}
      </td> 
      <td>{{ $p->description_fr }}
      </td> 
      <td>{{ $p->description_en }}
      </td> 
      <td width="100" align="center">
        <a href="{{ route('admin-blog-edit', $p->id) }}" class="btn btn-info btn-sm" title="Modifier"> <i class="fas fa-pencil-alt"></i></a>
        <a href="javascript();" data-toggle="modal" data-target="#del_blog" data-id="{{ $p->id }}" class="btn btn-danger btn-sm" title="Supprimer"> <i class="fas fa-trash"></i></a>
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