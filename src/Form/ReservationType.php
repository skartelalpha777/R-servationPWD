<?php

namespace App\Form;

use App\Entity\Representation;
use App\Entity\Reservation;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('booking_date')
            ->add('status')
            ->add('quantity', IntegerType::class,[
            ])
            /*->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ]) */
            ->add('representation', EntityType::class, [
                'class' => Representation::class,
                'choice_label' => function (Representation $representation) {
                    $titre = $representation->getRepresentationShow()->getTitle();
                    $date = $representation->getSchedule() ? $representation->getSchedule()->format('d/m/Y à H:i') : '';
                    return $titre . ' - ' . $date;
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
