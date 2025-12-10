<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $services = $options['services'];

        $builder
            // Bloc 1 : Vos informations
            ->add('first_name', TextType::class, [
                'label' => 'Nom *',
                'required' => true,
            ])
            ->add('last_name', TextType::class, [
                'label' => 'Prénom *',
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse e-mail *',
                'required' => true,
            ])
            ->add('phone', TelType::class, [
                'label' => 'Numéro de téléphone (facultatif)',
                'required' => false,
            ])

            // Bloc 2 : Intervention souhaitée
            ->add('service_type', ChoiceType::class, [
                'label' => 'Type de service *',
                'choices' => $services,
                'required' => true,
            ])
            ->add('address', TextAreaType::class, [
                'label' => 'Adresse complète de l’intervention *',
                'required' => true,
            ])
            ->add('date', DateType::class, [
                'label' => 'Date souhaitée *',
                'required' => true,
                'widget' => 'single_text',
                'attr' => [
                    'min' => (new \DateTime())->format('d-m-Y'),
                ]
            ])
            ->add('time_slot', ChoiceType::class, [
                'label' => 'Créneau horaire *',
                'choices' => [
                    '9h-12h' => '09:00-12:00',
                    '14h-18h' => '14:00-18:00',
                ],
                'required' => true,
            ])

            // Bloc 3 : Détails complémentaires
            ->add('message', TextAreaType::class, [
                'label' => 'Message ou précisions sur le problème',
                'required' => false,
            ])
            ->add('photo', FileType::class, [
                'label' => 'Ajouter une photo (facultatif)',
                'required' => false,
                'mapped' => false,
                'attr' => ['accept' => 'image/*'],
            ])
            ->add('emergency', CheckboxType::class, [
                'label' => 'Urgence',
                'required' => false,
            ])

            // Bloc 4 : Validation
            ->add('terms', CheckboxType::class, [
                'label' => 'Je certifie que les informations fournies sont correctes *',
                'required' => true,
            ])
            ->add('contact_permission', CheckboxType::class, [
                'label' => 'J’accepte d’être contacté pour confirmer ou ajuster le créneau (facultatif)',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'services' => []
        ]);
    }
}
