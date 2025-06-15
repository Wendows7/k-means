<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    protected $fillable = [
        'iteration',
        'cluster_1',
        'cluster_2',
        'cluster_3',
        'cluster_4',
    ];

    public  $timestamps = false;
}
