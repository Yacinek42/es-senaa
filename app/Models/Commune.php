<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;

    protected $table = 'commune'; // Nom exact dans votre base (singulier)
    protected $fillable = ['commune', 'commune_ar', 'daira_id', 'wilaya_id', 'post_code'];
}