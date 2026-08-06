@extends('layouts.frontend.template') 
<?php
  if( app()->getLocale() == 'fr' ){
    $langue = 'Détail Blogue';
  }else{
    $langue = 'Blog Detail';
  }
?>

@section('title', $langue)

@section('content')
   <!-- Start Page Title Area -->
    <div class="page-title-area page-title-bg3" @if(!empty($baniere) && $baniere->image) style="background-image: url('/frontend/assets/images/resource/{{ $baniere->image }}');" @endif>
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="page-title-content">
                        <h2>{{ app()->getLocale() == 'fr' ? 'Détail Blogue': 'Blog Detail' }}</h2>
                        <ul>
                            <li><a href="{{ route('index') }}">{{ app()->getLocale() == 'fr' ? 'Accueil': 'Home' }}</a></li>
                            <li>{{ app()->getLocale() == 'fr' ? 'Détail Blogue': 'Blog Detail' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->


    <!-- Start Blog Details Area -->
    <section class="blog-details-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="blog-details-desc">
                        <div class="article-image">
                            <img src="/frontend/assets/images/blog/{{$blog->image}}" alt="image">
                        </div>

                        <div class="article-content">
                            <div class="entry-meta">
                                <ul>
                                    <li><i class="fi fi-br-clock"></i> <a href="#">{{ date('d M Y', strtotime($blog->created_at)) }}</a></li>
                                    <li><i class="fi fi-br-user"></i> <a href="#">Admin</a></li>
                                </ul>
                            </div>

                            <h3>{{ app()->getLocale() == 'fr' ? $blog->title_fr: $blog->title_en }}</h3>

                            <p>
                            	<?= app()->getLocale() == 'fr' ? $blog->description_fr: $blog->description_en; ?>
                            </p>

                        </div>

                        <div class="article-footer">

                            <div class="article-share">
                                <ul class="social">
                                    <li><span>{{ app()->getLocale() == 'fr' ? 'Partager': 'Share' }}:</span></li>
                                    <li><a href="#" target="_blank"><i class="fi fi-brands-facebook"></i></a></li>
                                    <li><a href="#" target="_blank"><i class="fi fi-brands-linkedin"></i></a></li>
                                    <li><a href="#" target="_blank"><i class="fi fi-brands-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>

                        <!--
                        <div class="comments-area">
                            <h3 class="comments-title">2 Comments:</h3>

                            <ol class="comment-list">
                                <li class="comment">
                                    <article class="comment-body">
                                        <footer class="comment-meta">
                                            <div class="comment-author vcard">
                                                <img src="assets/img/client-image/1.jpg" class="avatar" alt="image">
                                                <b class="fn">John Jones</b>
                                                <span class="says">says:</span>
                                            </div>

                                            <div class="comment-metadata">
                                                <a href="#">
                                                    <time>April 24, 2024 at 10:59 am</time>
                                                </a>
                                            </div>
                                        </footer>

                                        <div class="comment-content">
                                            <p>Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen.</p>
                                        </div>

                                        <div class="reply">
                                            <a href="#" class="comment-reply-link">Reply</a>
                                        </div>
                                    </article>

                                    <ol class="children">
                                        <li class="comment">
                                            <article class="comment-body">
                                                <footer class="comment-meta">
                                                    <div class="comment-author vcard">
                                                        <img src="assets/img/client-image/2.jpg" class="avatar" alt="image">
                                                        <b class="fn">Steven Smith</b>
                                                        <span class="says">says:</span>
                                                    </div>
        
                                                    <div class="comment-metadata">
                                                        <a href="#">
                                                            <time>April 24, 2024 at 10:59 am</time>
                                                        </a>
                                                    </div>
                                                </footer>
        
                                                <div class="comment-content">
                                                    <p>Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen.</p>
                                                </div>
        
                                                <div class="reply">
                                                    <a href="#" class="comment-reply-link">Reply</a>
                                                </div>
                                            </article>
                                        </li>

                                        <ol class="children">
                                            <li class="comment">
                                                <article class="comment-body">
                                                    <footer class="comment-meta">
                                                        <div class="comment-author vcard">
                                                            <img src="assets/img/client-image/3.jpg" class="avatar" alt="image">
                                                            <b class="fn">Sarah Taylor</b>
                                                            <span class="says">says:</span>
                                                        </div>
            
                                                        <div class="comment-metadata">
                                                            <a href="#">
                                                                <time>April 24, 2024 at 10:59 am</time>
                                                            </a>
                                                        </div>
                                                    </footer>
            
                                                    <div class="comment-content">
                                                        <p>Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen.</p>
                                                    </div>
            
                                                    <div class="reply">
                                                        <a href="#" class="comment-reply-link">Reply</a>
                                                    </div>
                                                </article>
                                            </li>
                                        </ol>
                                    </ol>
                                </li>

                                <li class="comment">
                                    <article class="comment-body">
                                        <footer class="comment-meta">
                                            <div class="comment-author vcard">
                                                <img src="assets/img/client-image/4.jpg" class="avatar" alt="image">
                                                <b class="fn">John Doe</b>
                                                <span class="says">says:</span>
                                            </div>

                                            <div class="comment-metadata">
                                                <a href="#">
                                                    <time>April 24, 2024 at 10:59 am</time>
                                                </a>
                                            </div>
                                        </footer>

                                        <div class="comment-content">
                                            <p>Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen.</p>
                                        </div>

                                        <div class="reply">
                                            <a href="#" class="comment-reply-link">Reply</a>
                                        </div>
                                    </article>

                                    <ol class="children">
                                        <li class="comment">
                                            <article class="comment-body">
                                                <footer class="comment-meta">
                                                    <div class="comment-author vcard">
                                                        <img src="assets/img/client-image/1.jpg" class="avatar" alt="image">
                                                        <b class="fn">James Anderson</b>
                                                        <span class="says">says:</span>
                                                    </div>
        
                                                    <div class="comment-metadata">
                                                        <a href="#">
                                                            <time>April 24, 2024 at 10:59 am</time>
                                                        </a>
                                                    </div>
                                                </footer>
        
                                                <div class="comment-content">
                                                    <p>Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen.</p>
                                                </div>
        
                                                <div class="reply">
                                                    <a href="#" class="comment-reply-link">Reply</a>
                                                </div>
                                            </article>
                                        </li>
                                    </ol>
                                </li>
                            </ol>

                            <div class="comment-respond">
                                <h3 class="comment-reply-title">Leave a Reply</h3>

                                <form class="comment-form">
                                    <p class="comment-notes">
                                        <span id="email-notes">Your email address will not be published.</span>
                                        Required fields are marked 
                                        <span class="required">*</span>
                                    </p>
                                    <p class="comment-form-comment">
                                        <label>Comment</label>
                                        <textarea name="comment" id="comment" cols="45" rows="5" maxlength="65525" required="required"></textarea>
                                    </p>
                                    <p class="comment-form-author">
                                        <label>Name <span class="required">*</span></label>
                                        <input type="text" id="author" name="author" required="required">
                                    </p>
                                    <p class="comment-form-email">
                                        <label>Email <span class="required">*</span></label>
                                        <input type="email" id="email" name="email" required="required">
                                    </p>
                                    <p class="comment-form-url">
                                        <label>Website</label>
                                        <input type="url" id="url" name="url">
                                    </p>
                                    <p class="comment-form-cookies-consent">
                                        <input type="checkbox" value="yes" name="wp-comment-cookies-consent" id="wp-comment-cookies-consent">
                                        <label for="wp-comment-cookies-consent">Save my name, email, and website in this browser for the next time I comment.</label>
                                    </p>
                                    <p class="form-submit">
                                        <input type="submit" name="submit" id="submit" class="submit" value="Post Comment">
                                    </p>
                                </form>
                            </div>
                        </div>-->
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <aside class="widget-area" id="secondary">
                        <section class="widget widget_search">
                            <form class="search-form">
                                <label>
                                    <span class="screen-reader-text">{{ app()->getLocale() == 'fr' ? 'Rechercher pour': 'Search for' }}:</span>
                                    <input type="search" class="search-field" placeholder="{{ app()->getLocale() == 'fr' ? 'Rechercher pour': 'Search for' }}...">
                                </label>
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </section>

                        <section class="widget widget_pearo_posts_thumb">
                            <h3 class="widget-title">{{ app()->getLocale() == 'fr' ? 'Blogues Populaires': 'Popular Blogs' }}</h3>
                            @foreach( $blogs as $b )
	                            <article class="item">
	                                <a href="{{ route('detail-blog', $b->slug) }}" class="thumb">
	                                    <span class="fullimage cover" style="background: url('/frontend/assets/images/blog/{{$b->image}}');" role="img"></span>
	                                </a>
	                                <div class="info">
	                                    <time datetime="{{ $b->created_at }}">{{ date('d M Y', strtotime($b->created_at)) }}</time>
	                                    <h4 class="title usmall"><a href="{{ route('detail-blog', $b->slug) }}">{{ app()->getLocale() == 'fr' ? $b->title_fr: $b->title_en }}</a></h4>
	                                </div>

	                                <div class="clear"></div>
	                            </article>
                            @endforeach
                        </section>
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- End Blog Details Area -->
@endsection