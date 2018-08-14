<!doctype html>
<!--
  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
        <title>Material Design Lite</title>

        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

        <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
        <!--
        <link rel="canonical" href="http://www.example.com/">
        -->

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.cyan-light_blue.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <style>
        </style>
        <link rel="stylesheet" href="{{ url('css/custom.css') }}">
        <link rel="stylesheet" href="/css/mdl.css">
        <style>
            body.dragging, body.dragging * {
                cursor: move !important;
            }

            .dragged {
                position: absolute;
                opacity: 0.5;
                z-index: 2000;
            }

            .sortable {
                padding-left: 0;
                list-style: none;
            }

            #view-source {
                position: fixed;
                display: block;
                right: 0;
                bottom: 0;
                margin-right: 40px;
                margin-bottom: 40px;
                z-index: 900;
            }
        </style>
    </head>
    <body id="app">
        <div class=" layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
            <header class=" header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
                <div class="mdl-layout__header-row">
                    <span class="mdl-layout-title">@yield('title')</span>
                    <div class="mdl-layout-spacer"></div>
                    @yield('header_buttons')
                    <a href="{{ url('/logout') }}" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                        <i class="material-icons">vpn_key</i>
                    </a>
                </div>
            </header>
            <div class=" drawer mdl-layout__drawer mdl-color--cyan-900 mdl-color-text--blue-grey-50">
                <header class=" drawer-header">
                    <div class=" avatar-dropdown">
                        <span>{{ auth()->user()->name }}</span>
                        <div class="mdl-layout-spacer"></div>
                        <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                            <i class="material-icons" role="presentation">arrow_drop_down</i>
                            <span class="visuallyhidden">Accounts</span>
                        </button>
                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
                            <li class="mdl-menu__item">hello@example.com</li>
                            <li class="mdl-menu__item">info@example.com</li>
                            <li class="mdl-menu__item"><i class="material-icons">add</i>Add another account...</li>
                        </ul>
                    </div>
                </header>
                <ul class="sortable navigation mdl-navigation mdl-color--cyan-800">
                    <a class="{{ request()->is('home') ? 'mdl-active__link' : '' }} mdl-navigation__link" href="{{ url('/home') }}">Home</a>
                    @foreach(\App\Page::all()->sortBy('position') as $page)
                            <a class="sortable-item {{ request()->is('page/'.$page->id) ? 'mdl-active__link' : '' }} mdl-navigation__link" data-value="{{ $page->id }}" data-label="{{ $page->position }}" href="{{ url('/page/'.$page->id) }}">{{ $page->title }}</a>
                    @endforeach
                    <a data-toggle="dialog" class="mdl-navigation__link" href="{{ url('/page/create') }}"><i class="mdl-color-text--white-900 material-icons" role="presentation">add</i></a>
                    <div class="mdl-layout-spacer"></div>
                    <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">help_outline</i><span class="visuallyhidden">Help</span></a>
                </ul>
            </div>
            <main class="mdl-layout__content mdl-color--grey-100">
                <div id="app"></div>
                @yield('content')
            </main>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="{{ asset('/js/custom.js') }}"></script>
        <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        <script src="{{ asset('/js/dropzone.js') }}"></script>
        <script src="https://johnny.github.io/jquery-sortable/js/jquery-sortable.js"></script>
        <script>
            $(function () {
                $("ul.sortable").sortable({
                    itemSelector: '.sortable-item',
                    onDrop: function($item, container, _super) {
                        $item.find('ol.dropdown-menu').sortable('enable');
                        _super($item, container);
                        let next = $item.next().attr('data-value');
                        if (next === undefined || ($item.next().attr('data-label') - $item.attr('data-label')) > 1) {
                            next = $item.prev().attr('data-value')
                        }
                        let url = `{!! url('/move') !!}`+'/'+$item.attr('data-value')+'/'+ next;
                        console.log(url);
                        $.ajax(url);
                    },
                    onDragStart: function($item, container, _super) {
                        $item.find('ol.dropdown-menu').sortable('disable');
                        _super($item, container);
                    },
                });
            });
        </script>
        @yield('javascript')
    </body>
</html>
