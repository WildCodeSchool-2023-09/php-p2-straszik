<?php

namespace App\Controller;

class GroupeController extends AbstractController
{
    public function index(): string
    {
        $artists = [];

        $artists[] = [
            'img' => 'Groupe/Davele.jpg', 'name' => 'Davele',
            'desc' => 'David Weber est le bassiste du groupe,
        également chanteur et compositeur.
        Il a fondé le groupe en 1986 avec Philes.'
        ];
        $artists[] = [
            'img' => 'Groupe/Guigues.jpg', 'name' => 'Guigues',
            'desc' => 'Guillaume Marchand est a la guitare éléctrique,
         chanteur et compositeur.
        Il a rejoint le groupe en 2019.'
        ];
        $artists[] = [
            'img' => 'Groupe/Nickes.jpg', 'name' => 'Nickes',
            'desc' => 'Nicolas Biegel est a la basse ou guitare éléctrique, 
        chanteur et compositeur.
        Il a rejoint son premier groupe au lycée.'
        ];
        $artists[] = [
            'img' => 'Groupe/Philes.jpg', 'name' => 'Philes',
            'desc' => 'Philippe Metz est a la guitare accoustique, 
        chanteur et compositeur.
        Il a créer le groupe avec Davele en 1986.'
        ];
        $artists[] = [
            'img' => 'Groupe/Samele.jpg', 'name' => 'Samele',
            'desc' => 'Samuel Klein est le batteur du groupe,
         il compose également mais ne chante pas.'
        ];

        return $this->twig->render('Groupe/index.html.twig', ['artists' => $artists]);
    }
}
