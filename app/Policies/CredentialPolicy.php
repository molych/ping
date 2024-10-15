<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Credential;
use App\Models\User;
use Illuminate\Auth\Access\Response;

final class CredentialPolicy
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
     * @param Credential $credential
     * @return bool
     */
    public function view(User $user, Credential $credential): bool
    {
        return $user->id === $credential->user_id;
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
     * @param Credential $credential
     * @return bool
     */
    public function update(User $user, Credential $credential): bool
    {
        return $user->id === $credential->user_id;
    }

    /**
     * @param User $user
     * @param Credential $credential
     * @return bool
     */
    public function delete(User $user, Credential $credential): bool
    {
        return $user->id === $credential->user_id;
    }
}
