<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDescription extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'status',
        'inteviews_scheduled',
        'selected_candidates',
        'workspace',
        'created_by',
        'created_at',
        'updated_at'
    ];
}