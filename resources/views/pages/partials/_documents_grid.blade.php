{{-- Grille de documents PDF administrables (publications filtrees par type).
     $pubs : collection de Publication — $cols : largeur de colonne (4 ou 6) --}}
@php $cols = $cols ?? 4; @endphp

<section class="blog-area ptb-100">
    <div class="container">
        <div class="row">

            @forelse($pubs as $p)
            <div class="col-lg-{{ $cols }} col-md-6 text-center mb-5">
                <embed src="{{ $p->doc_url }}" width="100%" height="500" type="application/pdf"/>

                <a target="_blank" href="{{ $p->doc_url }}" class="btn btn-primary btn-lg mt-2">
                    <i class="icofont-eyes"></i>
                    {{ app()->getLocale() == 'fr' ? ($p->titre_fr ?: $p->titre_en) : ($p->titre_en ?: $p->titre_fr) }}
                </a>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <p style="font-size: 18px;">{{ app()->getLocale() == 'fr' ? 'Aucun document disponible pour le moment.': 'No documents available at the moment.' }}</p>
                </div>
            </div>
            @endforelse

        </div>
    </div>
</section>
