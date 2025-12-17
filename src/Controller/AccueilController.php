<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(): Response
    {
        $avis = [
            [
                'auteur' => 'Jennyfer',
                'texte' => 'Intervention rapide et très professionnelle. Le plombier a réglé la fuite en moins d’une heure. Je recommande vivement !'
            ],
            [
                'auteur' => 'Olivier',
                'texte' => 'Travail propre et soigné pour la rénovation de notre salle de bain. Équipe ponctuelle et de bons conseils. Nous sommes ravis du résultat.'
            ],
            [
                'auteur' => 'Sandra',
                'texte' => 'Service efficace et tarifs clairs. Très bonne communication.'
            ],
            [
                'auteur' => 'Medhi',
                'texte' => 'Très bon contact et intervention rapide.'
            ],
        ];

        return $this->render('accueil/index.html.twig', [
            'message' => 'Page Accueil',
            'avis' => $avis
        ]);
    }
}
