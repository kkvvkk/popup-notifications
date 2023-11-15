<?php

namespace Layer\Persistence\Entity\PopupNotifications;

use DateTimeImmutable;

class PopupNotificationEntity
{
    private int $id;
    private string $code;
    private string $type;
    private DateTimeImmutable $expireAt;

    public function __construct(
        int $id,
        string $code,
        string $type,
        DateTimeImmutable $expireAt
    ) {
        $this->id = $id;
        $this->code = $code;
        $this->type = $type;
        $this->expireAt = $expireAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getExpireAt(): DateTimeImmutable
    {
        return $this->expireAt;
    }
}
