<?php

namespace App\Form;

use App\Entity\Reservas;
use App\Entity\Usuarios;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class ReservasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fecha_checkin', null, [
                'widget' => 'single_text',
            ])
            ->add('fecha_checkout', null, [
                'widget' => 'single_text',
            ])
            ->add('estado', ChoiceType::class, [
                'choices' => [
                    'Pendiente' => 'Pendiente',
                    'Confirmada' => 'Confirmada',
                    'Cancelada' => 'Cancelada',
                ],
            ])
            ->add('precioReserva', MoneyType::class, [
                'currency' => 'EUR',
            ])
            ->add('tipoHabitacion', ChoiceType::class, [
                'choices' => [
                    'Individual' => 'Individual',
                    'Doble' => 'Doble',
                    'Suite' => 'Suite',
                ],
            ])
            ->add('id_usuario', EntityType::class, [
                'class' => Usuarios::class,
                'choice_label' => 'id',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservas::class,
        ]);
    }
}
