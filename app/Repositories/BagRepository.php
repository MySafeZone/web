<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Bag;

class BagRepository
{
    public function forUser(User $user)
    {
        return Bag::where('user_id', $user->id)
                    ->whereNull('send_at')
                    ->where('end_at', '>', date('Y-m-d H:i:s'))
                    ->orderBy('created_at')
                    ->get();
    }
}
?>