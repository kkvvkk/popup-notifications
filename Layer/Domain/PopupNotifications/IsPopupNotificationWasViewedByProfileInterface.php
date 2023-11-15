<?php

namespace Layer\Domain\PopupNotifications;

use Layer\Domain\PopupNotifications\Entity\PopupNotificationViewByProfile;

interface IsPopupNotificationWasViewedByProfileInterface
{
    public function is(PopupNotificationViewByProfile $popupNotificationViewByProfile): bool;
}
