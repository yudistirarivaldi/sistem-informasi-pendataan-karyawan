
    <div class="container">
        <a class="" href="{{ url('/') }}">
            @guest

            @else
            <span style="font-size: 14px">{{ Auth::user()->role->display_name ?? '' }}</span>
            @endguest
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>


    </div>

