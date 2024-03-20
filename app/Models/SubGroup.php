<?php

namespace App\Models;

use App\Models\Group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubGroup extends Model
{
    use HasFactory;

    protected $table = 'sub_groups';
    protected $fillable = ['group_id', 'sub_group_title','status'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
