<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Check;
use App\Models\User;
use Illuminate\Auth\Access\Response;

final class CheckPolicy
{
    /**
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * @param User $user
     * @param Check $check
     * @return bool
     */
    public function view(User $user, Check $check): bool
    {
        return $user->id === $check->service->user_id;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->hasVerifiedEmail();
    }

    /**
     * @param User $user
     * @param Check $check
     * @return bool
     */
    public function update(User $user, Check $check): bool
    {
        return $user->id === $check->service->user_id;
    }

    /**
     * @param User $user
     * @param Check $check
     * @return bool
     */
    public function delete(User $user, Check $check): bool
    {
        return $user->id === $check->service->user_id;
    }
}
