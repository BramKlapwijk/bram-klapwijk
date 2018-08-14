<dialog class="mdl-dialog" style="width: 25%; height: 25%">
    <h4 class="mdl-dialog__title">@yield('title')</h4>
    <div class="mdl-dialog__content">
        @yield('content')
    </div>
    <div class="mdl-dialog__actions">
        <button type="submit" form="create" class="mdl-button">Submit</button>
        <button type="button" class="mdl-button close">Cancel</button>
    </div>
</dialog>
