<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Division extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function auditors(): HasMany
    {
        return $this->hasMany(Auditor::class);
    }

    public function inviteMails(): HasMany
    {
        return $this->hasMany(InviteMail::class);
    }
}
