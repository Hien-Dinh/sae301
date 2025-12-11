<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CommandeType;
use App\Entity\Commande;
use Doctrine\ORM\EntityManagerInterface;


final class CommandeController extends AbstractController
{
    #[Route('/commande', name: 'app_commande')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $commande = new Commande();

        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // On gère la photo (si uploadée)
            $photoFile = $form->get('photo')->getData();
            if ($photoFile) {
                $newFilename = uniqid().'_'.$photoFile->getClientOriginalName();

                try {
                    $photoFile->move(
                        $this->getParameter('photos_directory'),
                        $newFilename
                    );
                } catch (FileException $e) { }

                $commande->setPhoto($newFilename);
            }

            // Ajout de la date de création
            $commande->setDateCreation(new \DateTime());

            // Sauvegarde dans la base de données
            $em->persist($commande);
            $em->flush();

            // Redirection vers page confirmation
            return $this->redirectToRoute('confirmation_commande', [
                'id' => $commande->getId()
            ]);
        }

        return $this->render('commande/index.html.twig', [
            'form' => $form->createView()
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
