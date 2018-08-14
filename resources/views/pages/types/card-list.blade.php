@extends('layouts.portal')

@section('title')
    {{ $page->title }}
@endsection

@section('header_buttons')
    <a href="{{ url('/page/delete/'. $page->id) }}" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
        <i class="material-icons">delete</i>
    </a>
@endsection

@section('content')
    <div class="mdl-grid  content">
        <button id="publish" style="margin-left: auto" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color-text--white mdl-button--accent">
            Publish
        </button>

        <div class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
            @foreach(json_decode($page->body) as $key => $item)
                <div style="height: 250px" class="mdl-cell editable-card mdl-cell--4-col mdl-cell--3-col-desktop">
                    @if(isset($item->icon))
                        <img style="height: 250px" data-toggle="{{ $key }}" src="{{ $item->icon }}">
                    @else
                        <div style="height: 250px" class="empty-icon" data-toggle="{{ $key }}"></div>
                    @endif
                    <i class="material-icons trash-card" data-content="{{ $key }}">delete</i>
                </div>
            @endforeach
            <div class="mdl-cell mdl-cell--4-col mdl-cell--3-col-desktop add-box">
                <i class="mdl-color-text--light-blue-500 material-icons" role="presentation">add</i>
            </div>
        </div>
        <section class="mdl-cell--12-col mdl-grid hide">
            <div class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
                <div class="mdl-textfield mdl-cell--12-col mdl-js-textfield">
                    <input class="mdl-textfield__input" type="text" id="url">
                </div>
            </div>

            <div style="margin: 20px" class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
                <form action="/file-upload" class="dropzone" id="dropzone">
                    <div class="fallback">
                        <input name="file" type="file" multiple/>
                    </div>
                </form>
            </div>

            <div class="editor mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col" style="width: 100%; height: 500px">
            </div>
        </section>
    </div>
@endsection

@section('javascript')
    <script>
        let items = JSON.parse({!! json_encode($page->body) ?? ''!!});
        console.log(items);
        var quill = new Quill('.editor', {
            theme: 'snow'
        });

        $('.hide').hide();

        $("[data-toggle]").click(function () {
            $('.hide').show().attr('id', $(this).attr('data-toggle'));
            sel_item = items[$(this).attr('data-toggle')];
            $('#url').val(sel_item.url);
            $('.ql-editor').html(sel_item.description).bind("DOMSubtreeModified", function () {
                let id = $('.hide').attr('id');
                items[id].description = $(this).html();
            });
        });

        Dropzone.options.dropzone = {
            paramName: "file", // The name that will be used to transfer the file
            url: 'bram-klapwijk.localhost/page/' + `{!! $page->id !!}`,
            uploadMultipled: true,
            method: 'POST',
            init: function () {
                this.on("processing", function (file) {
                    this.options.url = '/page/' + `{!! $page->id !!}` + '/cards/' + $('.hide').attr('id');
                });
                this.on("sending", function (file, xhr, formData) {
                    formData.append("_token", `{!! csrf_token() !!}`);
                });
                this.on("complete", function (file) {
                    this.removeFile(file);
                    items[$('.hide').attr('id')].icon = `{!! url('/images/page-images/'. $page->id .'/cards') !!}` + '/' + $('.hide').attr('id') + '.png';
                    publish();
                });
            }
        };

        $('#url').change(function () {
            let id = $('.hide').attr('id');
            items[id].url = $(this).val();
        });

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
        });

        $('.editable-card').mouseleave(function () {
            $(this).children('i').css('opacity', '0')
        });

        $('.add-box').click(function () {
            items.push({});
            publish();
        });

        $('.trash-card').click(function () {
            items.splice($(this).attr('data-content'), 1);
            publish();
        });

        $('#publish').click(function () {
            publish();
        });
    </script>
@endsection
