<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CommandeRepository;
use App\Entity\Commande;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\CommandeType;
use App\Repository\ServiceRepository;
use App\Repository\CreneauRepository;

final class BackOfficeController extends AbstractController
{
    #[Route('/backoffice', name: 'app_backoffice')]
    public function index(
        CommandeRepository $commandeRepository,
        ServiceRepository $serviceRepository,
        CreneauRepository $creneauRepository
    ): Response {
        $reservations = $commandeRepository->findBy([], ['dateCreation' => 'DESC']);

        $services = $serviceRepository->findBy(['actif' => true], ['nom' => 'ASC']);
        $availableSlots = [];

        foreach ($services as $service) {
            $creneaux = $creneauRepository->findBy(
                ['service' => $service, 'actif' => true],
                ['ordre' => 'ASC']
            );

            $availableSlots[$service->getNom()] = array_map(
                fn($c) => $c->getLibelle(),
                $creneaux
            );
        }

        return $this->render('back_office/index.html.twig', [
            'reservations' => $reservations,
            'availableSlots' => $availableSlots,
        ]);
    }

    #[Route('/backoffice/commande/{id}', name: 'app_backoffice_show')]
    public function show(Commande $commande): Response
    {
        return $this->render('back_office/show.html.twig', [
            'commande' => $commande
        ]);
    }

    #[Route('/backoffice/commande/{id}/modifier', name: 'app_backoffice_edit')]
    public function edit(Request $request, Commande $commande, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('app_backoffice_show', ['id' => $commande->getId()]);
        }

        return $this->render('back_office/edit.html.twig', [
            'form' => $form->createView(),
            'commande' => $commande
        ]);
    }

    #[Route('/backoffice/commande/{id}/supprimer', name: 'app_backoffice_delete', methods: ['POST'])]
    public function delete(Request $request, Commande $commande, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete_commande_' . $commande->getId(), $request->request->get('_token'))) {

            $em->remove($commande);
            $em->flush();
            $this->addFlash('success', 'La commande a été supprimée.');
        }

        return $this->redirectToRoute('app_backoffice');
    }
}
