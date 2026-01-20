<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>{{ __('site_title') }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('style_whmcs-blue.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slicebox.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/skins/blue.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css') }}">
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>


</head>

<body>
    <div id="Wrapper">
        <div id="Wrapper_Content">
            <div id="Container">
                <header>
                    <div id="Header">
                        @php
                            $logo = \App\Models\Setting::get('site_logo');
                        @endphp
                        <div class="Logo" @if($logo) style="background: none;" @endif>
                            @if($logo)
                                <a href="{{ url('/') }}">
                                    <img src="{{ asset('storage/' . $logo) }}" alt="{{ __('site_title') }}"
                                        style="max-width: 100%; max-height: 100%;">
                                </a>
                            @endif
                        </div>
                        <div class="language-switcher" {{ app()->getLocale() === 'ar' ? 'style="direction: rtl"' : '' }}>
                            <a href="{{ route('locale.switch', 'ar') }}"
                                class="{{ app()->getLocale() === 'ar' ? 'active' : '' }}" title="العربية">AR</a>
                            <a href="{{ route('locale.switch', 'en') }}"
                                class="{{ app()->getLocale() === 'en' ? 'active' : '' }}" title="English">EN</a>
                        </div>
                        <div class="Social_Icon">
                            <ul>
                                @php
                                    $socialLinks = \App\Models\SocialLink::getActive();
                                @endphp
                                @if($socialLinks->count() > 0)
                                    @foreach($socialLinks as $link)
                                        <li class="{{ $link->platform }}"><a href="{{ $link->url }}" target="_blank"
                                                title="{{ $link->platform }}"></a></li>
                                    @endforeach
                                @else
                                    <li class="facebook"><a href="#" target="_blank" title="facebook"></a></li>
                                    <li class="twitter"><a href="#" target="_blank" title="twitter"></a></li>
                                    <li class="youtube"><a href="#" target="_blank" title="youtube"></a></li>
                                    <li class="rss"><a href="#" target="_blank" title="rss"></a></li>
                                @endif
                            </ul>
                        </div>
                        <!--/Social_Icon-->
                        <nav>
                            <div class="Menu">
                                <div class="Menu_right"><a href="#"></a></div>
                                <ul>
                                    <li><a href="{{ route('welcome') }}"
                                            class="{{ request()->routeIs('welcome') ? 'active' : '' }}">{{ __('nav.home') }}</a>
                                    </li>
                                    @foreach(\App\Models\Page::where('is_active', true)->orderBy('order')->get() as $p)
                                        <li><a
                                                href="{{ route('page.show', $p->slug) }}">{{ $p->getTranslation('title', app()->getLocale()) }}</a>
                                        </li>
                                    @endforeach
                                    <li><a href="{{ route('contact') }}"
                                            class="{{ request()->routeIs('contact') ? 'active' : '' }}">{{ __('nav.contact') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                        <!--/Menu-->
                    </div>
                </header>
                <!--/Header-->
                <div id="Body">
                    <div id="Content">
                        <div id="Slider">
                            <div class="Slider">
                                <ul id="sb-slider" class="sb-slider">
                                    @if($sliderImages->count() > 0)
                                        @foreach($sliderImages as $image)
                                            <li>
                                                <img src="{{ asset('storage/' . $image->image_path) }}"
                                                    alt="{{ $image->title }}"
                                                    style="width: 708px; height: 240px; object-fit: cover; display: block;">
                                                @if($image->title || $image->description)
                                                    <div class="sb-description">
                                                        @if($image->title)
                                                            <h3>{{ $image->title }}</h3>
                                                        @endif
                                                        @if($image->description)
                                                            <h5>{{ $image->description }}</h5>
                                                        @endif
                                                    </div>
                                                @endif
                                            </li>
                                        @endforeach
                                    @else
                                        <!-- Fallback to static images if no dynamic images exist -->
                                        <li><a href="#"><img src="images/slider/slider_1.jpg" alt=""></a></li>
                                        <li><a href="#"><img src="images/slider/slider_2.jpg" alt=""></a></li>
                                        <li><a href="#"><img src="images/slider/slider_3.jpg" alt=""></a></li>
                                        <li><a href="#"><img src="images/slider/slider_4.jpg" alt=""></a></li>
                                        <li><a href="#"><img src="images/slider/slider_5.jpg" alt=""></a></li>
                                    @endif
                                </ul>
                            </div>
                            <!--/slider-->
                            <div id="nav-dots" class="nav-dots"> <span class="nav-dot-current"></span> <span></span>
                                <span></span> <span></span> <span></span>
                            </div>
                            <div class="slider_shadow"></div>
                        </div>
                        <!--/Slider-->
                        <div id="Our_Services">
                            <div class="Our_Services">
                                <ul>
                                    @if($services->count() > 0)
                                        @foreach($services as $service)
                                            <li class="{{ $service->icon_class }}"> <a href="#"></a>
                                                <div class="img"></div>
                                                <h2>{{ $service->getTranslation('title', app()->getLocale()) }}</h2>
                                                <p>{{ $service->getTranslation('description', app()->getLocale()) }}</p>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <!--/Services-->
                        <div id="Host_Table" style="direction: rtl">
                            <div class="Table_top" style="direction: rtl">
                                <h2 class="right">{{ $hostingPlans['silver']->name }} <span
                                        style="font-size:40px">{{ $hostingPlans['silver']->price }}</span><b>{{ $hostingPlans['silver']->currency }}</b>
                                </h2>
                                <h2 class="left">{{ $hostingPlans['gold']->name }} <span
                                        style="font-size:40px">{{ $hostingPlans['gold']->price }}</span><b>{{ $hostingPlans['gold']->currency }}</b>
                                </h2>
                            </div>
                            <!--/top-->
                            <div class="Table_options">
                                <ul class="options_right">
                                    <li>{{ __('pricing.space') }}<span>{{ $hostingPlans['silver']->features['space'][app()->getLocale()] ?? $hostingPlans['silver']->features['space']['en'] }}</span>
                                    </li>
                                    <li>{{ __('pricing.traffic') }}<span>{{ $hostingPlans['silver']->features['traffic'][app()->getLocale()] ?? $hostingPlans['silver']->features['traffic']['en'] }}</span>
                                    </li>
                                    <li>{{ __('pricing.support_24') }}<span>{{ $hostingPlans['silver']->features['support'][app()->getLocale()] ?? $hostingPlans['silver']->features['support']['en'] }}</span>
                                    </li>
                                </ul>
                                <ul class="options_left">
                                    <li>{{ __('pricing.space') }}<span>{{ $hostingPlans['gold']->features['space'][app()->getLocale()] ?? $hostingPlans['gold']->features['space']['en'] }}</span>
                                    </li>
                                    <li>{{ __('pricing.traffic') }}<span>{{ $hostingPlans['gold']->features['traffic'][app()->getLocale()] ?? $hostingPlans['gold']->features['traffic']['en'] }}</span>
                                    </li>
                                    <li>{{ __('pricing.support_24') }}<span>{{ $hostingPlans['gold']->features['support'][app()->getLocale()] ?? $hostingPlans['gold']->features['support']['en'] }}</span>
                                    </li>
                                </ul>
                            </div>
                            <!--/options-->
                            <div class="Table_details">
                                <ul class="details_right">
                                    <li>{{ $hostingPlans['silver']->features['databases'][app()->getLocale()] ?? $hostingPlans['silver']->features['databases']['en'] }}
                                    </li>
                                    <li>{{ $hostingPlans['silver']->features['subdomains'][app()->getLocale()] ?? $hostingPlans['silver']->features['subdomains']['en'] }}
                                    </li>
                                    <li>{{ $hostingPlans['silver']->features['emails'][app()->getLocale()] ?? $hostingPlans['silver']->features['emails']['en'] }}
                                    </li>
                                    <li>{{ $hostingPlans['silver']->features['ftp'][app()->getLocale()] ?? $hostingPlans['silver']->features['ftp']['en'] }}
                                    </li>
                                    <li class="false">{{ __('pricing.custom_design') }}</li>
                                </ul>
                                <ul class="details_left">
                                    <li>{{ $hostingPlans['gold']->features['databases'][app()->getLocale()] ?? $hostingPlans['gold']->features['databases']['en'] }}
                                    </li>
                                    <li>{{ $hostingPlans['gold']->features['subdomains'][app()->getLocale()] ?? $hostingPlans['gold']->features['subdomains']['en'] }}
                                    </li>
                                    <li>{{ $hostingPlans['gold']->features['emails'][app()->getLocale()] ?? $hostingPlans['gold']->features['emails']['en'] }}
                                    </li>
                                    <li>{{ $hostingPlans['gold']->features['ftp'][app()->getLocale()] ?? $hostingPlans['gold']->features['ftp']['en'] }}
                                    </li>
                                    <li class="false">{{ __('pricing.custom_design') }}</li>
                                </ul>
                            </div>
                            <!--/details-->
                            <div class="Table_bottom">
                                <ul>
                                    <li><a href="#" class="right">{{ __('pricing.order_now') }}</a></li>
                                    <li><a href="#" class="left">{{ __('pricing.order_now') }}</a></li>
                                </ul>
                            </div>
                            <!--/bottom-->
                            <div class="Host_Center">
                                <h2>{{ $hostingPlans['premium']->name }} <span
                                        style="font-size:40px">{{ $hostingPlans['premium']->price }}</span><b>{{ $hostingPlans['premium']->currency }}</b>
                                </h2>
                                <ul class="options">
                                    <li>{{ __('pricing.space') }}<span>{{ $hostingPlans['premium']->features['space'][app()->getLocale()] ?? $hostingPlans['premium']->features['space']['en'] }}</span>
                                    </li>
                                    <li>{{ __('pricing.traffic') }}<span>{{ $hostingPlans['premium']->features['traffic'][app()->getLocale()] ?? $hostingPlans['premium']->features['traffic']['en'] }}</span>
                                    </li>
                                    <li>{{ __('pricing.support_24') }}<span>{{ $hostingPlans['premium']->features['support'][app()->getLocale()] ?? $hostingPlans['premium']->features['support']['en'] }}</span>
                                    </li>
                                    <li>{{ __('pricing.free_domain') }}
                                        <span>{{ $hostingPlans['premium']->features['free_domain'][app()->getLocale()] ?? $hostingPlans['premium']->features['free_domain']['en'] }}</span>
                                    </li>
                                </ul>
                                <ul class="details">
                                    <li>{{ $hostingPlans['premium']->features['databases'][app()->getLocale()] ?? $hostingPlans['premium']->features['databases']['en'] }}
                                    </li>
                                    <li>{{ $hostingPlans['premium']->features['subdomains'][app()->getLocale()] ?? $hostingPlans['premium']->features['subdomains']['en'] }}
                                    </li>
                                    <li>{{ $hostingPlans['premium']->features['emails'][app()->getLocale()] ?? $hostingPlans['premium']->features['emails']['en'] }}
                                    </li>
                                    <li>{{ $hostingPlans['premium']->features['ftp'][app()->getLocale()] ?? $hostingPlans['premium']->features['ftp']['en'] }}
                                    </li>
                                    <li>{{ $hostingPlans['premium']->features['custom_design'][app()->getLocale()] ?? $hostingPlans['premium']->features['custom_design']['en'] }}
                                    </li>
                                </ul>
                                <div class="center_bottom"><a href="#">{{ __('pricing.order_now') }}</a></div>
                            </div>
                            <!--/Host_Center-->
                            <div class="Table_shadow"></div>
                        </div>
                        <!--/Host_Table-->
                    </div>
                    <!--/Content-->
                    <div id="Sidebar" style="direction: rtl">
                        <div class="Widget">
                            <h2 class="login">{{ __('sidebar.login_title') }} <span>-</span></h2>
                            <div class="Widget_Login">
                                @auth
                                    <div style="text-align: center; padding: 20px;">
                                        <ul>
                                            @if(auth()->user()->is_admin)
                                                <li style="margin-bottom: 10px;"><a href="{{ route('admin.dashboard') }}"
                                                        style="color: #3498db; font-weight: bold;">{{ __('admin.dashboard') }}</a>
                                                </li>
                                            @endif
                                            <li>
                                                <form action="{{ route('logout') }}" method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        style="background: none; border: none; color: #e74c3c; cursor: pointer; font-family: inherit; font-size: inherit;">{{ __('sidebar.logout') ?? 'Logout' }}</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                @else
                                    <form action="{{ route('login') }}" method="post" id="Login_Form">
                                        @csrf
                                        <input type="text" name="log" class="login_email"
                                            placeholder="{{ __('sidebar.email_placeholder') }}" value="{{ old('log') }}">
                                        @error('email')
                                            <span
                                                style="color: red; font-size: 10px; display: block; margin-bottom: 5px;">{{ $message }}</span>
                                        @enderror
                                        <input type="password" name="pwd" class="login_pass"
                                            placeholder="{{ __('sidebar.password_placeholder') }}">
                                        <input type="submit" value="{{ __('sidebar.login_button') }}" class="login_go">
                                        <ul>
                                            <li><a href="#">{{ __('sidebar.register') }}</a></li>
                                            <li><a href="#">{{ __('sidebar.forgot_password') }}</a></li>
                                        </ul>
                                    </form>
                                @endauth
                            </div>
                            <!--/Widget_Login-->
                        </div>
                        <!--/Widget-->
                        <div class="Widget">
                            <h2 class="links">{{ __('Links') }} <span>-</span></h2>
                            <div class="Widget_Links">
                                <ul>
                                    <li><a href="{{ route('welcome') }}">{{ __('nav.home') }}</a></li>
                                    @foreach(\App\Models\Page::where('is_active', true)->orderBy('order')->get() as $p)
                                        <li><a
                                                href="{{ route('page.show', $p->slug) }}">{{ $p->getTranslation('title', app()->getLocale()) }}</a>
                                        </li>
                                    @endforeach
                                    <li><a href="{{ route('contact') }}">{{ __('nav.contact') }}</a></li>
                                </ul>
                            </div>
                            <!--/Widget_Links-->
                        </div>
                        <!--/Widget-->

                    <!--/Sidebar-->
                </div>
                <!--/Body-->
                <!-- <div id="Services">
                    <nav> <a href="javascript:" class="next"></a><a href="javascript:" class="back"></a> </nav>
                    <div class="Services_Slider">
                        <ul>
                            <li> <img src="images/icons/safe.png" alt="">
                                <h2 style="color:#d96c25;">{{ __('features.security_title') }}</h2>
                                <p>{{ __('features.security_desc') }}</p>
                            </li>
                            <li> <img src="images/icons/support.png" alt="">
                                <h2 style="color:#478fda;">{{ __('features.support_title') }}</h2>
                                <p>{{ __('features.support_desc') }}</p>
                            </li>
                            <li> <img src="images/icons/stability.png" alt="">
                                <h2 style="color:#966fdd;">{{ __('features.stability_title') }}</h2>
                                <p>{{ __('features.stability_desc') }}</p>
                            </li>
                        </ul>
                    </div>
                </div> -->
                <!--/Services-->
                <div id="Footer">
                    <footer>
                        <div class="Footer_About">
                            <h2>{{ __('footer.about_title') }}</h2>
                            <a href="#">{{ __('footer.more') }}</a>
                            <p>{{ __('footer.about_desc') }}</p>
                        </div>
                        <!--/Footer_About-->
                        <div class="Footer_Links">
                            <h2>{{ __('footer.services_title') }}</h2>
                            <ul>
                                <li><a href="#">{{ __('footer.web_hosting') }}</a></li>
                                <li><a href="#">{{ __('footer.reseller_hosting') }}</a></li>
                                <li><a href="#">{{ __('footer.server_hosting') }}</a></li>
                                <li><a href="#">{{ __('footer.technical_support') }}</a></li>
                                <li><a href="#">{{ __('footer.seo') }}</a></li>
                                <li><a href="#">{{ __('footer.web_design') }}</a></li>
                                <li><a href="#">{{ __('footer.web_programming') }}</a></li>
                                <li><a href="#">{{ __('footer.advertising') }}</a></li>
                            </ul>
                        </div>
                        <!--/Footer_Links-->
                        <div class="Footer_Contact">
                            <h2>{{ __('footer.contact_title') }}</h2>
                            <p class="email">salse@tatwerat.com</p>
                            <p class="email">admin@tatwerat.com</p>
                            <p class="phone">01011606782 2+</p>
                            <p class="phone">01221344652 2+</p>
                        </div>
                        <!--/Footer_Contact-->
                        <div class="Footer_Bottom">
                            <p>{{ __('footer.copyright') }}</p>
                            <ul>
                                <li><a href="{{ route('welcome') }}">{{ __('Home') }}</a> | </li>
                                @foreach(\App\Models\Page::where('is_active', true)->orderBy('order')->get() as $p)
                                    <li><a
                                            href="{{ route('page.show', $p->slug) }}">{{ $p->getTranslation('title', app()->getLocale()) }}</a>
                                        | </li>
                                @endforeach
                                <li><a href="{{ route('contact') }}">{{ __('Contact') }}</a></li>
                            </ul>
                        </div>
                        <!--/Footer_Bottom-->
                    </footer>
                </div>
                <!--/Footer-->
            </div>
            <!--/Container-->
        </div>
        <!--/Wrapper_Conten-->
    </div>
    <!--/Wrapper-->
    <script type="text/javascript" src="{{ asset('js/jquery_easing.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jcarousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/slide-show.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/toll_tip.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/modernizr.custom.46884.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.slicebox.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.icheck.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/tatwerat.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/mobile-menu.js') }}"></script>
</body>

</html>
