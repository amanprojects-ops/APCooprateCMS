<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInquiry extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'subject', 'message',
        'service_interested', 'status', 'ip_address', 'user_agent',
    ];

    const STATUS_NEW     = 'new';
    const STATUS_READ    = 'read';
    const STATUS_REPLIED = 'replied';
    const STATUS_CLOSED  = 'closed';

    public static function statuses(): array
    {
        return [self::STATUS_NEW, self::STATUS_READ, self::STATUS_REPLIED, self::STATUS_CLOSED];
    }

    public function scopeNew($query)     { return $query->where('status', self::STATUS_NEW); }
    public function scopeUnread($query)  { return $query->whereIn('status', [self::STATUS_NEW]); }
}
