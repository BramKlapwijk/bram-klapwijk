<template>
    <div class="collection mt-5 container">
        <div class="row">
            <a v-for="card in cards" target="_blank" :href="card.url" class="showcase">
                <div></div>
                <article v-html="card.description">
                </article>
                <img :src="card.icon">
            </a>
        </div>
    </div>
</template>

<script>
    import Vue from 'vue';

    export default {
        name: "CardListComponent",
        props: [
            'title',
            'cards_string'
        ],
        data: function () {
            return {
                cards: JSON.parse(this.cards_string)
            }
        },
        mounted() {
            $('.showcase').hover(function () {
                $(this).children().first().css('opacity', '0.9');
                $(this).children().first().siblings('article').css('opacity', '1');
            }).mouseleave(function () {
                $(this).children().first().css('opacity', '0');
                $(this).children().first().siblings('article').css('opacity', '0');
            });
        }
    }
</script>

<style scoped>
    .row {
        justify-content: center;
    }

    .showcase:first-child {
        margin-left: 0;
    }

    .showcase {
        margin-left: 10px;
        margin-bottom: 20px;
    }

    .showcase img {
        width: 350px;
        height: 350px;
    }

    .showcase div {
        position: absolute;
        width: 350px;
        height: 350px;
        background-color: rgb(255, 255, 255);
        opacity: 0;
        transition: opacity 0.5s ease-in;
    }

    .showcase article {
        color: black;
        margin-left: 20px;
        position: absolute;
        opacity: 0;
        max-width: 310px;
        transition: opacity 0.5s ease-in;
    }
</style>
