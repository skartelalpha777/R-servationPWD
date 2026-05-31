<?php

namespace App\Enum;

enum Roles: string
{

    case Producteur = 'producteur';
    case Administrateur = 'admin';
    case Membre = 'membre';

    /*
     * @return Le roles mais avec une Majuscule lors de l'affichage 
     */
  /*  public function getLabel(): string
    {
        return match ($this) {
            self::Producteur => 'Producteur',
            self::Administrateur => 'Administrateur',
            self::Membre => 'Membre'
        };
    } */
}
