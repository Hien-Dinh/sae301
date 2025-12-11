<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BackOfficeController extends AbstractController
{
    #[Route('/backoffice', name: 'app_back_office')]
    public function index(): Response
    {
        // Données simulées pour les réservations
        $reservations = [
            [
                'client' => 'Jean Dupont',
                'service' => 'Réparation fuite d\'eau',
                'creneau' => '2025-12-12T10:00:00',
                'duree' => '1h30',
                'statut' => 'Confirmée'
            ],
            [
                'client' => 'Marie Durand',
                'service' => 'Installation chauffe-eau',
                'creneau' => '2025-12-12T14:00:00',
                'duree' => '2h',
                'statut' => 'En attente'
            ],
            [
                'client' => 'Luc Martin',
                'service' => 'Débouchage canalisation',
                'creneau' => '2025-12-13T09:00:00',
                'duree' => '1h',
                'statut' => 'Confirmée'
            ],
            [
                'client' => 'Claire Petit',
                'service' => 'Réparation fuite WC',
                'creneau' => '2025-12-13T13:00:00',
                'duree' => '1h15',
                'statut' => 'Annulée'
            ]
        ];

        // Créneaux horaires disponibles
        $availableSlots = [
            '2025-12-12' => ['10:00', '14:00'],
            '2025-12-13' => ['09:00', '13:00', '15:00']
        ];

        return $this->render('back_office/index.html.twig', [
            'reservations' => $reservations,
            'availableSlots' => $availableSlots,
        ]);
    }
}
