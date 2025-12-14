<?php

namespace App\Form;

use App\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $services = $options['services'] ?? [];
        $creneauxParService = $options['creneaux_par_service'] ?? [];
        $defaultServiceName = $options['default_service'] ?? null;

        $serviceChoices = [];
        foreach ($services as $service) {
            $serviceChoices[$service->getNom()] = $service->getNom();
        }

        $creneauChoices = [];
        if ($defaultServiceName && isset($creneauxParService[$defaultServiceName])) {
            foreach ($creneauxParService[$defaultServiceName] as $libelle) {
                $creneauChoices[$libelle] = $libelle;
            }
        }

        $builder
            ->add('prenom', TextType::class, [
                'label' => '* Prénom',
                'attr' => [
                    'placeholder' => 'Ex : Jean',
                ],
            ])

            ->add('nom', TextType::class, ['label' => '* Nom',
                'attr' => [
                    'placeholder' => 'Ex : Dupont',
                ],
            ])

            ->add('email', EmailType::class, ['label' => '* Adresse e-mail',
                'attr' => [
                    'placeholder' => 'Ex : exemple@email.com'
                ],
            ])

            ->add('telephone', TextType::class, ['label' => '* Téléphone',
                'attr' => [
                    'placeholder' => 'Ex : 00 00 00 00 00'
                ],
            ])

            ->add('typeService', ChoiceType::class, [
                'label' => '* Type de service',
                'choices' => $serviceChoices,
                'placeholder' => 'Choisissez un service',
            ])
            ->add('adresse', TextType::class, ['label' => '* Adresse de l’intervention',
                'attr' => [
                    'placeholder' => 'Ex : 9 Rue Quebec, 10430 Rosières-près-Troyes'
                ],
            ])

            ->add('dateSouhaitee', DateType::class, [
                'label' => 'Date souhaitée',
                'widget' => 'single_text'
            ])
            ->add('creneauHoraire', ChoiceType::class, [
                'label' => '* Créneau horaire',
                'choices' => $creneauChoices,
                'placeholder' => $defaultServiceName ? 'Choisissez un créneau' : 'Choisissez d’abord un service',
            ])

            ->add('message', TextareaType::class, [
                'label' => 'Message (optionnel)',
                'required' => false,
            ])
            ->add('photo', FileType::class, [
                'label' => 'Photo (optionnel)',
                'required' => false,
                'mapped' => false,
            ])
            ->add('urgence', CheckboxType::class, [
                'label' => 'Intervention urgente?',
                'required' => false,
            ])
            ->add('accepteConditions', CheckboxType::class, [
                'label' => '* J’accepte les conditions générales',
            ])
            ->add('autorisationContact', CheckboxType::class, [
                'label' => 'Autorisez-vous le contact?',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
            'services' => [],
            'creneaux_par_service' => [],
            'default_service' => null,
        ]);
    }
}
