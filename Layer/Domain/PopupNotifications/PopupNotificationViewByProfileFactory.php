<?php

namespace Layer\Domain\PopupNotifications;

use Layer\Domain\PopupNotifications\Entity\PopupNotificationViewByProfile;

class PopupNotificationViewByProfileFactory
{
    public function make(
        int $popupNotificationId,
        int $profileId
    ): PopupNotificationViewByProfile {
        return new PopupNotificationViewByProfile(
            $popupNotificationId,
            $profileId
        );
    }
}
