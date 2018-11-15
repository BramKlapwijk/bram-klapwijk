<template>
    <div class="banner" :style="{backgroundImage: 'url('+background+')'}">
        <div class="card mx-auto">
            <div class="card-body">
                <div v-if="image">
                    <img style="width: 400px; border-radius: 4px" :src="image">
                </div>
                <div v-html="text" class="ml-3">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Vue from 'vue';
    export default {
        name: "TextComponent",
        props: [
            'background',
            'text',
            'image'
        ]
    }
</script>

<style scoped>
    .card {
        width: 50%;
    }
    @media only screen and (max-width: 1183px) {
        .card {
            width: 70% !important;
        }
    }
</style>
