<?php

namespace Layer\Domain\PopupNotifications;

use Layer\Domain\PopupNotifications\Entity\PopupNotification;

interface GetOneActivePopupNotificationByCodeInterface
{
    public function get(string $popupCode): PopupNotification;
}
