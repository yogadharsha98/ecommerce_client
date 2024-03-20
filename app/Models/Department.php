<?php

namespace App\Models;

use App\Models\Group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;
    protected $fillable = ['department_title', 'status', 'image'];

    public function groups()
    {
        return $this->hasMany(Group::class);
    }
}
