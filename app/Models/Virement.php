<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Virement extends Model
{
    use HasFactory;

    protected $table = 'virements';

    protected $primaryKey = 'num_virements';

    protected $fillable = [
        'num_compte',
        'montant',
        'date_virement'
    ];

    public $timestamps = true;
}
