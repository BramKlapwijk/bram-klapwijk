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

        <div style="margin: 20px" class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
            <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-1">
                <input type="checkbox" id="switch-1" class="mdl-switch__input">
                <span class="mdl-switch__label">Background-image</span>
            </label>
            <form action="/file-upload" class="dropzone" id="dropzone">
                <div class="fallback">
                    <input name="file" type="file" multiple />
                </div>
            </form>
        </div>
        <div class="editor mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col" style="width: 100%; height: 500px">
            {!! json_decode($page->body)->text ?? '' !!}
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        let items = JSON.parse({!! json_encode($page->body) ?? ''!!});

        var quill = new Quill('.editor', {
            theme: 'snow',
        });

        $('.ql-editor').on('keyup',function () {
            console.log('hey:'+$('.ql-editor').html());
            items.text = $('.ql-editor').html();
            console.log(items);
        });

        Dropzone.options.dropzone = {
            paramName: "file", // The name that will be used to transfer the file
            url: 'bram-klapwijk.localhost/page/'+`{!! $page->id !!}`,
            uploadMultipled: true,
            method: 'POST',
            init: function() {
                this.on("processing", function(file) {
                    let type = $('#switch-1').is(":checked") ? '/background/' : '/image/';
                    this.options.url = '/page/'+`{!! $page->id !!}`+type+'1';
                });
                this.on("sending", function(file, xhr, formData){
                    formData.append("_token", `{!! csrf_token() !!}`);
                });
                this.on("complete", function(file) {
                    this.removeFile(file);
                    if ($('#switch-1').is(":checked")) {
                        items.background_image = '/images/page-images/'+`{!! $page->id !!}`+'/background/1.png'
                    } else {
                        items.img = '/images/page-images/'+`{!! $page->id !!}`+'/image/1.png'
                    }
                    publish();
                });
            }
        };

        function publish() {
            $.post('/page/save/{!! $page->id !!}', {
                '_token': `{!! csrf_token() !!}`,
                'body': JSON.stringify(items)
            }).always(function (e) {
                console.log(e);
                location.reload();
            });
        }

        $('#publish').click(function () {
            publish();
        });
    </script>
@endsection
