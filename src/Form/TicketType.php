<?php

namespace App\Form;

use App\Entity\Ticket;
use App\Entity\Caissier;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numeroTicket', TextType::class, [
                'label' => 'Numéro du ticket',
                'attr' => ['class' => 'form-control']
            ])
            ->add('date', DateTimeType::class, [
                'label' => 'Date et heure',
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control']
            ])
            ->add('caissier', EntityType::class, [
                'class' => Caissier::class,
                'choice_label' => 'nom',
                'label' => 'Caissier',
                'attr' => ['class' => 'form-select']
            ])
            ->add('produits', EntityType::class, [
                'class' => Produit::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => false,
                'label' => 'Produits',
                'attr' => ['class' => 'form-select']
            ])
            ->add('montantTotal', NumberType::class, [
                'label' => 'Montant total',
                'attr' => [
                    'class' => 'form-control',
                    // Supprimer 'readonly' => true pour rendre le champ éditable
                ]
                ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
        ]);
    }
}