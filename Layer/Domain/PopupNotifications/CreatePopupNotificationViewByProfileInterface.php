<?php

namespace Layer\Domain\PopupNotifications;

use Layer\Domain\PopupNotifications\Entity\PopupNotificationViewByProfile;

interface CreatePopupNotificationViewByProfileInterface
{
    public function run(PopupNotificationViewByProfile $popupNotificationViewByProfile): void;
}
