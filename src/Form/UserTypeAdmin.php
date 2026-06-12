<?php

namespace App\Form;

use App\Entity\User;
use App\Enum\Roles;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\EmailValidator;

class UserTypeAdmin extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            // ->add('roles')
            ->add('password', PasswordType::class)
            ->add('firstname')
            ->add('lastname')
            /*   ->add('role', EnumType::class, [
                'class' => Roles::class,
                'choice_label' => fn(Roles $choice) => $choice->value,
                'label' => 'Rôle de l\'utilisateur'
            ])*/
            ->add('role', ChoiceType::class, [
                'choices' => [
                    'Producteur' => Roles::Producteur,
                    'Administrateur' => Roles::Administrateur,
                    'Membre' => Roles::Membre
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
