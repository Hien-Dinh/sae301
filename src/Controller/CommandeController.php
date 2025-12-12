<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CommandeType;
use App\Entity\Commande;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ServiceRepository;
use App\Repository\CreneauRepository;

final class CommandeController extends AbstractController
{
    #[Route('/commande', name: 'app_commande')]
    public function index(Request $request, EntityManagerInterface $em, ServiceRepository $serviceRepository, CreneauRepository $creneauRepository): Response
    {
        $commande = new Commande();
        $services = $serviceRepository->findBy(['actif' => true], ['nom' => 'ASC']);
        $creneaux = $creneauRepository->findBy(['actif' => true], ['ordre' => 'ASC']);

        $creneauxParService = [];
        foreach ($creneaux as $creneau) {
            $serviceName = $creneau->getService()->getNom();
            $creneauxParService[$serviceName][] = $creneau->getLibelle();
        }

        $defaultServiceName = $services ? $services[0]->getNom() : null;

        $form = $this->createForm(CommandeType::class, $commande, [
            'services' => $services,
            'creneaux_par_service' => $creneauxParService,
            'default_service' => $defaultServiceName,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $photoFile = $form->get('photo')->getData();
            if ($photoFile) {
                $newFilename = uniqid() . '_' . $photoFile->getClientOriginalName();
                $photoFile->move($this->getParameter('photos_directory'), $newFilename);
                $commande->setPhoto($newFilename);
            }

            $commande->setDateCreation(new \DateTime());
            $em->persist($commande);
            $em->flush();

            return $this->redirectToRoute('confirmation_commande', [
                'id' => $commande->getId()
            ]);
        }

        return $this->render('commande/index.html.twig', [
            'form' => $form->createView(),
            'creneaux_par_service' => $creneauxParService,
        ]);
    }

    #[Route('/commande/confirmation/{id}', name: 'confirmation_commande')]
    public function confirmation(Commande $commande): Response
    {
        return $this->render('commande/confirmation.html.twig', [
            'form_data' => $commande
        ]);
    }
}
