<?php

namespace Layer\Domain\PopupNotifications;

use Layer\Domain\PopupNotifications\Entity\PopupNotification;

interface GetActivePopupNotificationsByTypeInterface
{
    /**
     * @param string $popupType
     *
     * @return PopupNotification[]
     */
    public function get(string $popupType): array;
}
