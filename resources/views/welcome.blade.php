@extends('layouts.app')
@section('content')
    <div id="app">
        @foreach($pages as $page)
            @if($page->type === 'text')
                <text-component background="{{ json_decode($page->body)->background_image }}" text="{{ json_decode($page->body)->text }}" image="{{ json_decode($page->body)->img }}"></text-component>
            @elseif($page->type === 'card-list')
                <card-list cards_string="{{ $page->body }}"></card-list>
            @elseif($page->type === 'slider')
                <slider-component slides_string="{{ $page->body }}"></slider-component>
            @endif
        @endforeach
    </div>
    <footer>
        <div>
            <ul>
                <li><a href="https://www.linkedin.com/in/bram-k-a3809a132/"><i class="fab fa-linkedin-in"></i></li>
                <li><a href="https://github.com/BramKlapwijk"><i class="fab fa-github"></i></a></li>
                <li><a href="mailto:bram.klapwijk00@outlook.com"><i class="fas fa-at"></i></a></li>
                <li><a href="https://twitter.com/KlapwijkBram"><i class="fab fa-twitter"></i></a></li>
            </ul>
        </div>
    </footer>
@endsection
<script>
    import TextComponent from "../assets/js/components/TextComponent";

    export default {
        components: {TextComponent}
    }
</script>
