<?php

namespace Layer\Persistence\Model\PopupNotifications;

use Layer\Domain\PopupNotifications\Entity\PopupNotificationViewByProfile;
use Layer\Persistence\Entity\PopupNotifications\PopupNotificationViewByProfileEntity;

class PopupNotificationViewByProfileModel
{
    public function fromDomain(
        PopupNotificationViewByProfile $popupNotificationViewByProfile
    ): PopupNotificationViewByProfileEntity {
        return new PopupNotificationViewByProfileEntity(
            $popupNotificationViewByProfile->getPopupNotificationId(),
            $popupNotificationViewByProfile->getProfileId()
        );
    }
}
