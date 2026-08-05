@if( $temoignage->isNotEmpty() )

@foreach( $temoignage as $t )

<div>

  <?php if ( isset( $t->image ) ): ?>
    <img width="50" class="img-circle" src="/frontend/assets/images/temoignages/{{ $t->image }}">
    <?php else: ?>
      <i class="fa fa-user bg-green"></i>
  <?php endif ?>
  
  <div class="timeline-item">

    <span class="time"><i class="fas fa-clock"></i> 00:05</span>

    <h3 class="timeline-header"><a href="#">{{ $t->name }}</a></h3>



    <div class="timeline-body">

      {{ $t->content_fr }}

    </div>

    <div class="timeline-footer">

      <a href="{{ route('admin-temoignage-edit', $t->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i> Modifier</a>

      <a href="javascript();" data-toggle="modal" data-target="#del_temoignage" data-id="{{ $t->id }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Supprimer</a>

    </div>
  </div>

</div>

@endforeach



@else

  <p>

    Pas de témoignages disponible en ce moment!

  </p>

@endif