
<footer class="main-footer s-two">

          <div class="main-footer-top">

              <div class="theme_container">

                  <div class="widgets-section">

                      <div class="row clearfix">

                          <div class="col-xl-3 col-md-6 wow animated fadeInUp" data-wow-delay="0.1s">

                              <div class="footer-widget-item">

                                  <div class="title"><h2>@lang('menu.menu_contact')</h2></div>

                                  <div class="icon-list">

                                      <ul>

                                          <li>

                                              <div class="icon"><i class="far fa-map-marker-alt"></i></div>

                                              <div class="text-location style-two">8-165 Plymouth Rd, Welland, ON, L3B 3E1</div>

                                          </li>

                                          <li>

                                              <div class="icon"><i class="far fa-envelope"></i></div>

                                              <div class="text"><a href="emailto:info@sofifran.org">info@sofifran.org</a></div>

                                          </li>

                                          <li>

                                              <div class="icon"><i class="far fa-phone"></i></div>

                                              <div class="text"><a href="tel:+(905) 714-7333">+1 (905) 714-7333 <br> +1 (905)-226-5282</a></div>

                                          </li>

                                      </ul>

                                  </div>

                                  <a href="{{ route('contact') }}" class="primary_btn style-six">@lang('menu.menu_contact') <i class="far fa-phone"></i></a>

                              </div>

                          </div>

                          <div class="col-xl-3 col-md-6 wow animated fadeInUp" data-wow-delay="0.3s">

                              <div class="footer-widget">

                                  <div class="title"><h2>@lang('general.autre_link')</h2></div>

                                  <div class="icon-list">

                                      <ul>

                                        

                                          <li>

                                              <a href="{{ route('partenaires') }}"><i class="far fa-arrow-right"></i>@lang('menu.menu_nospartenaire')</a>

                                          </li>

                                          <li>

                                              <a href="{{ route('team') }}"><i class="far fa-arrow-right"></i>@lang('menu.menu_team')</a>

                                          </li>

                                          <li>

                                              <a href="{{ route('about') }}"><i class="far fa-arrow-right"></i>@lang('menu.menu_historique')</a>

                                          </li>

                                          <li>

                                              <a href="{{ route('about') }}"><i class="far fa-arrow-right"></i>@lang('menu.menu_mission_objectif')</a>

                                          </li>

                                          <li>

                                              <a href="{{ route('temoignage') }}"><i class="far fa-arrow-right"></i>@lang('menu.menu_temoignage')</a>

                                          </li>

                                          

                                      </ul>

                                  </div>

                              </div>

                          </div>

                          <div class="col-xl-3 col-md-6 wow animated fadeInUp" data-wow-delay="0.3s">

                              <div class="footer-widget-item mar-t50 s-two">

                                  <div class="title"><h2>@lang('general.blog_recent')</h2></div>

                                  <div class="footer-widget-news">

                                      <ul>

                                        <?php $blog = DB::table('blogs')->latest()->paginate(3); ?>

                                          <?php foreach ($blog as $b): ?>

                                            <?php 

                                              $titre = 'blog.titre'.$b->id;

                                              $description = 'blog.description'.$b->id;

                                             ?>

                                            <li>

                                                <div class="img-box">

                                                    <a href="{{ route('detail-blog', $b->slug) }}"><img width="200" src="/assets/images/blog/{{ $b->image }}" alt="" /></a>

                                                </div>

                                                <div class="text-box">

                                                    <p><span class="far fa-calendar-alt"></span><a href="#">{{ date('d M Y', strtotime($b->created_at)) }}</a></p>

                                                    <h6>

                                                        <a href="{{ route('detail-blog', $b->slug) }}">

                                                            <?= substr(trans($description), 0,50); ?>...

                                                        </a>

                                                    </h6>

                                                </div>

                                            </li>



                                          <?php endforeach ?>

                                      </ul>

                                  </div>

                              </div>

                          </div>

                          <div class="col-xl-3 col-md-6 wow animated fadeInUp" data-wow-delay="0.5s">

                              <div class="footer-widget-item-2 mar-l13">

                                  <div class="title"><h2>Newsletter</h2></div>

                                  <div class="footer-widget-newsletter">

                                      <p>

                                          @lang('general.newsletter')

                                      </p>

                                      <div class="subscribe-box">

                                          <form class="subscribe-form" action="#">

                                              <div class="input-box">

                                                  <input type="email" name="email" placeholder="Enter Email" /> <button type="submit"><span class="far fa-arrow-right"></span></button>

                                              </div>

                                          </form>

                                      </div>

                                      <div class="social-link">

                                          <ul>

                                              <li>

                                                  <a target="_blank" href="https://www.facebook.com/Sofifran-101320351789936/"><i class="fab fa-facebook-f"></i></a>

                                              </li>

                                              <li>

                                                  <a target="_blank" href="https://www.youtube.com/channel/UCI1RPtrZQAW24uoy3jQLrWQ"><i class="fab fa-youtube"></i></a>

                                              </li>
                                              <li>

                                                  <a target="_blank" href="https://twitter.com/sofifranniagara"><i class="fab fa-twitter"></i></a>

                                              </li>
                                              <li>

                                                  <a target="_blank" href="https://www.instagram.com/sofifran_niagara/"><i class="fab fa-instagram"></i></a>

                                              </li>

                                          </ul>

                                      </div>

                                  </div>

                              </div>

                          </div>

                      </div>

                  </div>

              </div>

          </div>

          <div class="main-footer-bottom">

              <div class="theme_container">

                  <div class="main-footer-bottom-inner">

                      <ul>

                          <li><a href="#">@lang('general.condition_use')</a></li>

                          <li><a href="#">@lang('general.politique_confid')</a></li>

                      </ul>

                      <div class="text"><p>Copyright © 2022 <a href="https://markel-tech.com" target="_blank">Markel Technology</a>. @lang('general.droit_reserve')</p></div>

                  </div>

              </div>

          </div>

      </footer>

  </div>

  <a href="# " class="back-to-top" data-wow-duration="1.0s " data-wow-delay="1.0s "> <i class="fas fa-angle-up"></i> </a>