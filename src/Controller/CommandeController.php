<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CommandeType;
use Symfony\Component\HttpFoundation\RequestStack;

final class CommandeController extends AbstractController
{
    private $requestStack;
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    #[Route('/commande', name: 'app_commande')]
    public function index(Request $request): Response
    {
        $services = [
            'Fuite' => 'fuite',
            'Dépannage' => 'depannage',
            'Installation' => 'installation',
            'Raccordement' => 'raccordement',
        ];

        $form = $this->createForm(CommandeType::class, null, [
            'services' => $services
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $session = $this->requestStack->getCurrentRequest()->getSession();
            $session->set('form_data', $formData);
            return $this->redirectToRoute('app_commande_confirmation');
        }

        return $this->render('commande/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/commande/confirmation', name: 'app_commande_confirmation')]
    public function confirmation(): Response
    {
        $session = $this->requestStack->getCurrentRequest()->getSession();
        $formData = $session->get('form_data');

        if (!$formData) {
            return $this->redirectToRoute('app_commande');
        }

        return $this->render('commande/confirmation.html.twig', [
            'form_data' => $formData,
        ]);
    }
}
