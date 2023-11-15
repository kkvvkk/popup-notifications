<?php

namespace Layer\Domain\PopupNotifications\Entity;

class PopupNotificationViewByProfile
{
    private int $popupNotificationId;
    private int $profileId;

    public function __construct(
        int $popupNotificationId,
        int $profileId
    ) {
        $this->popupNotificationId = $popupNotificationId;
        $this->profileId = $profileId;
    }

    public function getPopupNotificationId(): int
    {
        return $this->popupNotificationId;
    }

    public function getProfileId(): int
    {
        return $this->profileId;
    }
}
