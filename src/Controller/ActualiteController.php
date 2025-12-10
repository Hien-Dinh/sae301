<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ActualiteController extends AbstractController
{
    #[Route('/actualite', name: 'app_actualite')]
    public function index(): Response
    {
         $articles = [
            [
                'id' => 1,
                'title' => 'Les nouvelles normes de plomberie 2023',
                'image' => '/images/plomberie_article1.jpg',
                'date' => new \DateTime('2023-11-20'),
                'category' => 'Normes et Régulations',
                'excerpt' => 'Découvrez les nouvelles normes qui impactent l\'installation de vos systèmes de plomberie pour cette année.',
            ],
            [
                'id' => 2,
                'title' => 'Comment entretenir vos canalisations',
                'image' => '/images/plomberie_article2.jpg',
                'date' => new \DateTime('2023-11-18'),
                'category' => 'Entretien',
                'excerpt' => 'Suivez nos conseils pour prévenir les bouchons et assurer le bon fonctionnement de vos canalisations.',
            ],
            [
                'id' => 3,
                'title' => 'Réparer une fuite de robinet en 5 étapes',
                'image' => '/images/plomberie_article3.jpg',
                'date' => new \DateTime('2023-11-15'),
                'category' => 'DIY',
                'excerpt' => 'Une fuite de robinet peut être facilement réparée à la maison. Voici un guide rapide pour vous aider.',
            ],
            [
                'id' => 4,
                'title' => 'Les tendances de la plomberie écoresponsable',
                'image' => '/images/plomberie_article4.jpg',
                'date' => new \DateTime('2023-11-10'),
                'category' => 'Innovation',
                'excerpt' => 'L\'éco-plomberie est en plein essor. Découvrez les meilleures pratiques et équipements pour une plomberie plus durable.',
            ]
        ];

        return $this->render('actualite/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}