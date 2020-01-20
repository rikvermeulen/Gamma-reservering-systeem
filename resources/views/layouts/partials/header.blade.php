<header class="header">
    <div class="header-container">
        <nav>
            <a class="logo" href="">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 112 40" focusable="false"
                     style="border-radius: 2px;"><title>GAMMA</title>
                    <path fill="#003978" d="M0 0h112v40H0z"></path>
                    <path fill="#FFF"
                          d="M103 27.9H89c-.68 0-1.25-.57-1.25-1.3v-7.98c0-.72.57-1.3 1.26-1.3h6.4v2.64h-3.8v5.3h6.35v-10.6H91.6V12h10.16c.7 0 1.26.6 1.26 1.32v14.6M82.7 12h-14c-.7 0-1.25.6-1.25 1.32v14.6h3.8V14.64h2.55v5.3h2.54v-5.3h2.54V27.9h5.08V13.33c0-.73-.56-1.32-1.26-1.32m-20.33 0h-14c-.68 0-1.25.6-1.25 1.35v14.6h3.8v-13.3h2.55v5.3H56v-5.3h2.54V27.9h5.08V13.33c0-.73-.57-1.32-1.27-1.32M43.3 27.9h-14c-.7 0-1.25-.57-1.25-1.3v-7.98c0-.72.56-1.3 1.26-1.3h6.4v2.64h-3.8v5.3h6.35v-10.6H31.9V12h10.16c.7 0 1.26.6 1.26 1.32v14.6M16.62 17.3v2.66h3.8v5.3H14.1v-10.6h10.17V12h-14c-.7 0-1.25.6-1.25 1.32V26.6c0 .73.56 1.3 1.26 1.3h13.98V17.3h-7.62"></path>
                </svg>
            </a>
            <ul>
                <li><a href="/products">Assortiment</a></li>
                <li><a href="">klusadvies</a></li>
                <li><a href="">service</a></li>
                <li><a href="">actie</a></li>
            </ul>
        </nav>
        <div class="login">
            <ul>
                <li>
                    <a href="">Ridderkerk</a>
                </li>
                @if (! (request()->is('checkout') || request()->is('guestCheckout')))
                @guest()
                <li>
                    <a href="{{ route('login') }}">Login</a>
                </li>
                <li>
                    <a href="{{ route('register') }}">Sign up</a>
                </li>

                @else
                        <li>
                            <a href="{{ route('users.edit') }}">My Account</a>
                        </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                    </li>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endguest
                @endif
            </ul>
        </div>
        <div class="search">
            <form action="">
                <div class="search-input">
                    <input type="search" name="text" autocomplete="off" autocapitalize="off" autocorrect="off" aria-autocomplete="list" placeholder="Zoeken naar... " required="" value="">
                </div>
                <button type="submit" class="searchbar__Button-st5ohe-1 kZmhYk">
                    {{--<span class="searchbar__Hidden-st5ohe-3 jEQptF">Zoeken</span>--}}
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 250.3 250.3" width="20" height="20" focusable="false"><path d="M244.2 214.6l-54.4-54.4-1-.7a103 103 0 1 0-29.4 29.4l.8 1 54.4 54.3a21 21 0 0 0 29.6-29.6zm-141.3-44.5a67.2 67.2 0 1 1 0-134.4 67.2 67.2 0 0 1 0 134.4z" fill="#fff" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                    {{--<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 250.3 250.3" width="20" height="20" class="shadow" focusable="false"><path d="M244.2 214.6l-54.4-54.4-1-.7a103 103 0 1 0-29.4 29.4l.8 1 54.4 54.3a21 21 0 0 0 29.6-29.6zm-141.3-44.5a67.2 67.2 0 1 1 0-134.4 67.2 67.2 0 0 1 0 134.4z" fill="#000" fill-rule="evenodd" clip-rule="evenodd" class="shadow"></path></svg>
                --}}</button>
            </form>
        </div>
        <div class="icons">
            <a href="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
            </a>
            <a href="{{ route('cart.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: -4px;"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                @if(Cart::instance('default')->count() > 0)
                    <span>{{ Cart::instance('default')->count() }}</span>
                @endif
            </a>
        </div>
    </div>
</header>
