<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NiveauScolaire extends Model
{
    use HasFactory;

    // On spécifie le nom exact de votre table dans la base de données
    protected $table = 'niveaux_scolaires';

    // On spécifie la colonne que l'on veut utiliser
    protected $fillable = ['Nom'];
}