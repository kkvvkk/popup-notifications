<?php

namespace Layer\Domain\PopupNotifications\Entity;

class PopupNotification
{
    private int $id;
    private string $code;
    private string $type;
    private string $title;
    private string $description;

    public function __construct(
        int $id,
        string $code,
        string $type,
        string $title,
        string $description
    ) {
        $this->id = $id;
        $this->code = $code;
        $this->type = $type;
        $this->title = $title;
        $this->description = $description;
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

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
