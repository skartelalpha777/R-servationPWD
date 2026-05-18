<?php

namespace App\Enum;

enum Roles: string
{

    case Producteur = 'producteur';
    case Administrateur = 'administrateur';
    case Membre = 'membre';
}
