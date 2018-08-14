<?php

use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Page::firstOrCreate([
            'title' => 'Info',
            'type' => 'text',
            'body' => json_encode(['img' => url('/images/profile.jpg'), 'background_image' => url('/images/bus.jpg'), 'text' => "<h1>Bram Klapwijk</h1>
                    <p>
                        Muzieksmaak: Pink floyd, Madeon
                        <span data-toggle=\"tooltip\" data-placement=\"top\" title=\"Radiohead, Kensington..\">en nog veel meer</span><br>
                        Geboren: 18-07-2000<br>
                        Wonende: Deventer<br>
                        <br>
                        Frameworks waar ik mij in kan redden:
                    </p>
                    <article>
                        <ul>
                            <li>Vue.js</li>
                            <li>Angular 4</li>
                            <li>Ionic</li>
                            <li>React Native</li>
                            <li>Laravel</li>
                            <li>Jquery</li>
                        </ul>
                    </article>"]),
            'position' => 0,
        ]);
        \App\Page::firstOrCreate([
            'title' => 'Portofolio',
            'type' => 'card-list',
            'body' => json_encode([
                ['icon' => url('/images/deltion-bus-icon.png'), 'url' => 'deltion-bus.bram-klapwijk.nl', 'description' => '
                    <h3>Deltion-bus</h3>
                    Deze app voorspelt de drukte in de deltion bus op basis van het rooster van alle klassen. Om dit allemaal te kunnen onderhouden zit er een backend achter die de roosters up-to-date houdt en eventuele variable kan bewerken.
                    <br>
                    <ul>
                        <li>Ionic 3</li>
                        <li>Laravel 5.6</li>
                    </ul>'],
                ['icon' => url('/images/bier-vue-icon.png'), 'url' => 'vue.bram-klapwijk.nl', 'description' => '
                    <h3>Bier tabel</h3>
                    Deze SPA (single page application) haal alle bieren op uit een api en sorteert, filtert en paginate ze met vue.
                    <br>
                    <ul>
                        <li>Vue</li>
                        <li>Lumen</li>
                    </ul>'],
                ['icon' => url('/images/depoort-icon.png'), 'url' => 'pao.bram-klapwijk.nl', 'description' => '
                    <h3>De poort portal</h3>
                    Dit is een portaal voor een huisartsen praktijk waarin ze consults kunnen aanmaken en afronden. Dit is gemaakt voor school als opdracht
                    <ul>
                        <li>Laravel 5.6</li>
                    </ul>'],
                ['icon' => url('/images/rapid-icon.png'), 'url' => 'rapid.bram-klapwijk.nl', 'description' => '
                    <h3>Rapid</h3>
                    Rapid is een website wat het deltion gebruikt alleen de site was vreselijk verouderd. Daarom heb ik de site teruggebracht naar het heden. Echter is het alleen styling en is het niet het officiele programma
                '],
                ['icon' => url('/images/klapwijk-icon.png'), 'url' => 'klapwijkparkmanagement.nl', 'description' => '
                    <h3>Klapwijk-parkmanagement</h3>
                    Een site voor klapwijk parkmanagement met een cms systeem op de achtergrond zodat zij zelf de teksten en afbeeldingen kunnen aanpassen.'],
            ]),
            'position' => 1,
        ]);
        \App\Page::firstOrCreate([
            'title' => 'Slider',
            'type' => 'slider',
            'body' => json_encode([
                ['img' => url('/images/slides/deltion-bus.png')],
                ['img' => url('/images/slides/depoort.png')],
                ['img' => url('/images/slides/mountains-blue.jpg')]
            ])
        ]);
    }
}
