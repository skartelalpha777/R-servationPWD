<?php

namespace App\Form;

use App\Entity\Price;
use App\Entity\Representation;
use App\Entity\RepresentationReservation;
use App\Entity\Reservation;
use Doctrine\Common\Collections\Expr\Value;
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
            // ->add('status')

            /* ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ]) */
            ->add('representations', EntityType::class, [
                'class' => Representation::class,
                'label' => ' ',
                'choice_label' => function (Representation $representation) {

                    $titre = $representation->getRepresentationShow() ? $representation->getRepresentationShow()->getTitle() : 'Spectacle inconnu';
                    $prix =  $representation->getPrice() ? $representation->getPrice() . ' €' : 'Prix non défini';
                    $showTime = $representation->getSchedule() ? $representation->getSchedule()->format('d/m/Y à H:i') : 'Date inconnue';
                    return $titre . ' - Date : ' . $showTime . '   Prix : ' . $prix;
                },
                'multiple' => true,
                'mapped' => false,
                'expanded' => false,

            ])
            ->add('price', EntityType::class, [
                'class' => Price::class,
                'label' => 'Prix',
                'choice_label' => function (Price $prix) {

                    $type = $prix->getType() ? $prix->getType()->value : 'Type indefini';
                    $prix = $prix->getPrice() ? $prix->getPrice() : 'Prix indefini';
                    return 'Type: ' . $type . 'Prix : ' . $prix;
                },
                'multiple' => true,
                'mapped' => false,
                'expanded' => false,

            ])
            ->add('quantity', IntegerType::class, [

                'mapped' => false,
            ])
            /* ->add('representation', EntityType::class, [
                'class' => Representation::class,
                'choice_label' => function (Representation $representation) {
                    $titre = $representation->getRepresentationShow()->getTitle();
                    $date = $representation->getSchedule() ? $representation->getSchedule()->format('d/m/Y à H:i') : '';
                    return $titre . ' - ' . $date;
                },
            ]) */
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
