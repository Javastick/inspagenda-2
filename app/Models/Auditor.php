<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Auditor extends Model
{
    use HasFactory;

    protected $fillable = ['division_id', 'name', 'status'];

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function inviteMails(): BelongsToMany
    {
        return $this->belongsToMany(InviteMail::class, 'auditor_schedule');
    }
}
