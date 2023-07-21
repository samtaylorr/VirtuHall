<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    /**
     * The custom properties of the classroom
     *
     * @var string
     * @var string
     * @var string
     * @var string
     */
    protected $fillable = ['className', 'ownerId', 'uuid', 'section','subject', "room"];
}
