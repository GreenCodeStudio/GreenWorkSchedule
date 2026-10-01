<?php

namespace WorkSchedule;

use WorkSchedule\Repository\ICalTokenRepository;

class ICalExporter
{
    public function getKeys(int $ownerUserId)
    {

        $all = (new ICalTokenRepository())->getAllToken($ownerUserId);
        if (empty($all)) {
            $all = bin2hex(random_bytes(16));
            (new ICalTokenRepository())->insert(['token' => $all, 'owner_user_id' => $ownerUserId]);
        }
        $own=(new ICalTokenRepository())->getUsersToken($ownerUserId, $ownerUserId);
        if(empty($own)) {
            $own = bin2hex(random_bytes(16));
            (new ICalTokenRepository())->insert(['token' => $own, 'owner_user_id' => $ownerUserId, 'target_user_id' => $ownerUserId]);
        }
        return ['all' => $all, 'own' => $own];
    }
}
