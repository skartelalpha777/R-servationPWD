<?php

namespace App\Enum;

enum Roles: string
{

    case Producteur = 'ROLE_PRODUCTEUR';
    case Administrateur = 'ROLE_ADMIN';
    case Membre = 'ROLE_MEMBRE';

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
