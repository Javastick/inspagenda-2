<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class InviteMail extends Model
{
    use HasFactory;

    protected $table = 'invite_mails';

    protected $fillable = [
        'sender',
        'masuk',
        'hari',
        'kegiatan',
        'tempat',
        'keterangan',
        'division_id',
        'status_pelaksanaan'
    ];

    protected $casts = [
        'masuk' => 'date',
        'hari' => 'datetime'
    ];

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function auditors(): BelongsToMany
    {
        return $this->belongsToMany(Auditor::class, 'auditor_schedule');
    }
}
