<template>
    <div id="carouselIndicators" style="height: 900px" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li v-for="(slide, key) in slides" :class="{active: isActive(key)}" :onclick="this.pos = key"></li>
        </ol>
        <div style="height: 900px" class="carousel-inner">
            <div v-for="(slide, key) in slides" class="carousel-item" :class="{active: isActive(key)}">
                <img class="d-block w-100" :src="slide.img" alt="First slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</template>

<script>
    import Vue from 'vue';

    export default {
        name: "SliderComponent",
        props: [
            'slides_string'
        ],
        data() {
            return {
                pos: 0,
                slides: JSON.parse(this.slides_string)
            }
        },
        methods : {
            isActive: function (key) {
                console.log(key, this.pos);
                return this.pos === key;
            }
        }
    }
</script>

<style scoped>
</style>
