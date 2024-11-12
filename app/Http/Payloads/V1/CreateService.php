<?php

namespace App\Http\Payloads\V1;

final class CreateService
{
    public function __construct(
        private readonly string $name,
        private readonly string $url,
        private readonly string $user,
    ) {}

    /**
     * @return array{
     *     name:string,
     *     url:string,
     *     user_id:string
     * }
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'url' => $this->url,
            'user_id' => $this->user,
        ];
    }
}
