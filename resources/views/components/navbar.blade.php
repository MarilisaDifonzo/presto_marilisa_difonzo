<nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow">
    <div class="container-fluid">

        <a class="navbar-brand" href="{{ route('homepage') }}">
            Presto.it
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('homepage') }}">
                        {{ __('ui.home') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('article.index') }}">
                        {{ __('ui.all_articles') }}
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        {{ __('ui.categories') }}
                    </a>

                    <ul class="dropdown-menu">
                        @foreach ($categories as $category)
                            <li>
                                <a class="dropdown-item text-capitalize"
                                   href="{{ route('byCategory', ['category' => $category]) }}">
                                    {{ __("ui.$category->name") }}
                                </a>
                            </li>

                            @if (!$loop->last)
                                <li><hr class="dropdown-divider"></li>
                            @endif
                        @endforeach
                    </ul>
                </li>

                @auth

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            {{ __('ui.hello_user') }} {{ Auth::user()->name }}
                        </a>

                        <ul class="dropdown-menu">

                            <li>
                                <a class="dropdown-item" href="{{ route('create.article') }}">
                                    {{ __('ui.create') }}
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item"
                                   href="#"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('ui.logout') }}
                                </a>

                                <form id="logout-form"
                                      action="{{ route('logout') }}"
                                      method="POST"
                                      class="d-none">
                                    @csrf
                                </form>
                            </li>

                        </ul>
                    </li>

                    @if (Auth::user()->is_revisor)

                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-success btn-sm position-relative"
                               href="{{ route('revisor.index') }}">

                                {{ __('ui.revisor') }}

                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ \App\Models\Article::toBeRevisedCount() }}
                                </span>

                            </a>
                        </li>

                    @endif

                @else

                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            {{ __('ui.hello_user') }}
                        </a>

                        <ul class="dropdown-menu">

                            <li>
                                <a class="dropdown-item" href="{{ route('login') }}">
                                    {{ __('ui.login') }}
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <a class="dropdown-item" href="{{ route('register') }}">
                                    {{ __('ui.register') }}
                                </a>
                            </li>

                        </ul>

                    </li>

                @endauth

            </ul>

            <x-_locale lang="it"/>
            <x-_locale lang="uk"/>
            <x-_locale lang="es"/>

            <form class="d-flex ms-auto"
                  role="search"
                  action="{{ route('article.search') }}"
                  method="GET">

                <div class="input-group">

                    <input
                        type="search"
                        name="query"
                        class="form-control"
                        placeholder="{{ __('ui.search') }}"
                    >

                    <button class="btn btn-outline-success" type="submit">
                        {{ __('ui.search') }}
                    </button>

                </div>

            </form>

        </div>

    </div>
</nav>