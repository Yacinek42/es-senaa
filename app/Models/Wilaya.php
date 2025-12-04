<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilaya extends Model
{
    use HasFactory;

    // Nom de la table exact
    protected $table = 'wilaya';

    // Les colonnes exactes de votre base de données (d'après votre image)
    protected $fillable = ['num', 'wilaya', 'wilaya_ar'];
}