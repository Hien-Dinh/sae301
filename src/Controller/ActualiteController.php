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
                'title' => 'Nouveau service',
                'image' => 'images/1.1.png',
                'date' => new \DateTime('08/12/2025'),
                'excerpt' => 'Lancement du dépannage express 7j/7 dans toute la région.',
            ],
             [
                 'id' => 2,
                 'title' => 'Promo du mois',
                 'image' => 'images/1.2.png',
                 'date' => new \DateTime('08/12/2025'),
                 'excerpt' => 'Lancement du dépannage express 7j/7 dans toute la région.',
             ],
             [
                 'id' => 3,
                 'title' => 'Nouveau service',
                 'image' => 'images/1.3.png',
                 'date' => new \DateTime('08/12/2025'),
                 'excerpt' => 'Lancement du dépannage express 7j/7 dans toute la région.',
             ],
             [
                 'id' => 4,
                 'title' => 'Nouveau service',
                 'image' => 'images/2.1.png',
                 'date' => new \DateTime('08/12/2025'),
                 'excerpt' => 'Lancement du dépannage express 7j/7 dans toute la région.',
             ],
             [
                 'id' => 5,
                 'title' => 'Nouveau service',
                 'image' => 'images/2.2.png',
                 'date' => new \DateTime('08/12/2025'),
                 'excerpt' => 'Lancement du dépannage express 7j/7 dans toute la région.',
             ],
             [
                 'id' => 6,
                 'title' => 'Nouveau service',
                 'image' => 'images/2.3.png',
                 'date' => new \DateTime('08/12/2025'),
                 'excerpt' => 'Lancement du dépannage express 7j/7 dans toute la région.',
             ],
             [
                 'id' => 7,
                 'title' => 'Nouveau service',
                 'image' => 'images/3.1.png',
                 'date' => new \DateTime('08/12/2025'),
                 'excerpt' => 'Lancement du dépannage express 7j/7 dans toute la région.',
             ],
             [
                 'id' => 8,
                 'title' => 'Nouveau service',
                 'image' => 'images/3.2.png',
                 'date' => new \DateTime('08/12/2025'),
                 'excerpt' => 'Lancement du dépannage express 7j/7 dans toute la région.',
             ],
             [
                 'id' => 9,
                 'title' => 'Nouveau service',
                 'image' => 'images/3.3.png',
                 'date' => new \DateTime('08/12/2025'),
                 'excerpt' => 'Lancement du dépannage express 7j/7 dans toute la région.',
             ],
        ];

        return $this->render('actualite/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}
