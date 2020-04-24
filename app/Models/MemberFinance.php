<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberFinance extends Model
{
    protected $guarded = [];

    public function member()
    {
        return $this->hasOne(Member::class, 'id', 'mid');
    }
}
