{{-- Cartes de documents administrables (publications filtrees par type).
     $pubs : collection de Publication — $cols : largeur de colonne (4 ou 6).
     Aucun PDF n'est charge d'avance : couverture (ou vignette stylisee),
     titre, date, poids, puis Consulter / Telecharger. --}}
@php $cols = $cols ?? 4; $fr = app()->getLocale() == 'fr'; @endphp

<section class="blog-area ptb-100">
    <div class="container">
        <div class="row">

            @forelse($pubs as $p)
            @php
                $titre  = $fr ? ($p->titre_fr ?: $p->titre_en) : ($p->titre_en ?: $p->titre_fr);
                $taille = $p->tailleFichier();
                $date   = $p->datePub();
            @endphp
            <div class="col-lg-{{ $cols }} col-md-6 mb-4 d-flex">
                <div class="doc-card">
                    <a href="{{ $p->doc_url }}" target="_blank" rel="noopener" class="doc-cover" title="{{ $fr ? 'Consulter' : 'View' }} — {{ $titre }}">
                        @if($p->cover_url)
                            <img loading="lazy" src="{{ $p->cover_url }}" alt="{{ $titre }}">
                        @else
                            <span class="doc-cover-placeholder">
                                <i class="fi fi-br-document"></i>
                                <em>{{ \Illuminate\Support\Str::limit($titre, 60) }}</em>
                            </span>
                        @endif
                        <span class="doc-cover-overlay"><i class="fi fi-br-eye"></i> {{ $fr ? 'Consulter' : 'View' }}</span>
                    </a>

                    <div class="doc-body">
                        <h3 class="doc-title" title="{{ $titre }}">{{ $titre }}</h3>

                        <div class="doc-meta">
                            @if($date)<span><i class="fi fi-br-calendar"></i> {{ $date }}</span>@endif
                            <span><i class="fi fi-br-document"></i> PDF{{ $taille ? ' · ' . $taille : '' }}</span>
                        </div>

                        <div class="doc-actions">
                            <a href="{{ $p->doc_url }}" target="_blank" rel="noopener" class="doc-btn doc-btn-primary">
                                <i class="fi fi-br-eye"></i> {{ $fr ? 'Consulter' : 'View' }}
                            </a>
                            <a href="{{ $p->doc_url }}" download class="doc-btn doc-btn-outline">
                                <i class="fi fi-br-download"></i> {{ $fr ? 'Télécharger' : 'Download' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <p style="font-size: 18px;">{{ $fr ? 'Aucun document disponible pour le moment.' : 'No documents available at the moment.' }}</p>
                </div>
            </div>
            @endforelse

        </div>
    </div>
</section>
