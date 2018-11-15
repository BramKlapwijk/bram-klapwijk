@extends('layouts.portal')

@section('style')
    <style>
        .trash-card {
            left: 0;
        }
    </style>
@endsection

@section('title')
    {{ $page->title }}
@endsection

@section('header_buttons')
    <a href="{{ url('/page/delete/'. $page->id) }}" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
        <i class="material-icons">delete</i>
    </a>
@endsection

@section('content')
    <div class="mdl-grid content">
        <button id="publish" style="margin-left: auto" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color-text--white mdl-button--accent">
            Publish
        </button>

        <div class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid mdl-layout__center">
            @foreach(json_decode($page->body) as $key => $item)
                <div class="mdl-cell editable-card slider-editable-card mdl-cell--5-col mdl-cell--5-col-desktop" data-toggle="{{ $key }}" style="background-image: url('{{ $item->img ?? '' }}')">
                    @if(!isset($item->img))
                        <div style="height: 230px" class="empty-icon"></div>
                    @endif
                    <i class="material-icons slider-trash-card" data-content="{{ $key }}">delete</i>
                </div>
            @endforeach
            <div style="height: 230px" class="mdl-cell mdl-cell--5-col mdl-cell--5-col-desktop add-box server-add-box">
                <i class="mdl-color-text--light-blue-500 material-icons" role="presentation">add</i>
            </div>
        </div>
        <section class="mdl-cell--12-col mdl-grid hide">
            <div style="margin: 20px" class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
                <form action="/file-upload" class="dropzone" id="dropzone">
                    <div class="fallback">
                        <input name="file" type="file" multiple/>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection

@section('javascript')
    <script>
        let items = JSON.parse({!! json_encode($page->body) ?? ''!!});

        $('.hide').hide();

        $("[data-toggle]").click(function () {
            $('.hide').show().attr('id', $(this).attr('data-toggle'));
            sel_item = items[$(this).attr('data-toggle')];
        });

        Dropzone.options.dropzone = {
            paramName: "file", // The name that will be used to transfer the file
            url: 'bram-klapwijk.localhost/page/' + `{!! $page->id !!}`,
            uploadMultipled: true,
            method: 'POST',
            init: function () {
                this.on("processing", function (file) {
                    console.log($('.hide').attr('id'));
                    this.options.url = '/page/' + `{!! $page->id !!}` + '/slides/' + $('.hide').attr('id');
                });
                this.on("sending", function (file, xhr, formData) {
                    formData.append("_token", `{!! csrf_token() !!}`);
                });
                this.on("complete", function (file) {
                    this.removeFile(file);
                    items[$('.hide').attr('id')].img = `{!! url('/images/page-images/'. $page->id .'/slides') !!}` + '/' + $('.hide').attr('id') + '.png';
                    publish();
                });
            }
        };

        function publish() {
            $.post('/page/save/{!! $page->id !!}', {
                '_token': `{!! csrf_token() !!}`,
                'body': JSON.stringify(items)
            }).always(function () {
                location.reload();
            });
        }

        $('.editable-card').mouseover(function () {
            $(this).children('i').css('opacity', '1')
        }).mouseleave(function () {
            $(this).children('i').css('opacity', '0')
        });

        $('.add-box').click(function () {
            items.push({});
            publish();
        });

        $('.slider-trash-card').click(function () {
            items.splice($(this).attr('data-content'), 1);
            publish();
        });

        $('#publish').click(function () {
            publish();
        });
    </script>
@endsection
