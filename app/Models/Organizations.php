<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizations extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public function organizationUsers()
    {
        return $this->hasMany(OrganizationUser::class,'organization_id');
    }
}
