<?php

namespace App\Form;

use App\Entity\Creneau;
use App\Entity\Service;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreneauType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            ->add('actif')
            ->add('ordre')
            ->add('service', EntityType::class, [
                'class' => Service::class,
                'choice_label' => 'nom',
                'label' => 'Service associé',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Creneau::class,
        ]);
    }
}
