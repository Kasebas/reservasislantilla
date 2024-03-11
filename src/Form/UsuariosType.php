<?php

namespace App\Form;

use App\Entity\Usuarios;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UsuariosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre_Usuario')
            ->add('email')
            ->add('contrasena')
            ->add('rol_usuario', ChoiceType::class, [
                'choices' => [
                    'Cliente' => 'Cliente',
                    'Administrador' => 'Administrador',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuarios::class,
        ]);
    }
}
