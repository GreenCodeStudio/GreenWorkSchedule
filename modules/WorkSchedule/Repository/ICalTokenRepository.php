<?php

namespace WorkSchedule\Repository;

use Core\Database\DB;
use Exception;


class ICalTokenRepository extends \Core\Repository
{

    public function __construct()
    {
        $this->archiveMode = static::ArchiveMode_OnlyExisting;
    }

    public function defaultTable(): string
    {
        return 'ical_token';
    }

    public function getAllToken(int $ownerUserId)
    {
        return (DB::get("SELECT token FROM ical_token WHERE owner_user_id = ? AND target_user_id IS NULL",[$ownerUserId])[0]??null)?->token;
    }
    public function getUsersToken(int $ownerUserId, int $targetUserId)
    {
        return (DB::get("SELECT token FROM ical_token WHERE owner_user_id = ? AND target_user_id = ?",[$ownerUserId, $targetUserId])[0]??null)?->token;
    }
}
