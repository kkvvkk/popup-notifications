<?php

namespace Layer\Persistence\Model\PopupNotifications;

use Layer\Infrastructure\Translation\DomainEnum;
use Layer\Infrastructure\Translation\TranslationProvider;
use Layer\Domain\PopupNotifications\Entity\PopupNotification as BusinessPopupNotification;
use Layer\Persistence\Entity\PopupNotifications\PopupNotificationEntity as DbPopupNotificationEntity;

class PopupNotificationModel
{
    private TranslationProvider $translationProvider;

    public function __construct(TranslationProvider $translationProvider)
    {
        $this->translationProvider = $translationProvider;
    }

    public function toBusiness(DbPopupNotificationEntity $dbPopupNotificationEntity): BusinessPopupNotification
    {
        $title = $this->translationProvider->translateForCurrentLanguage(
            $dbPopupNotificationEntity->getCode(),
            DomainEnum::POPUP_NOTIFICATION_TITLE
        );

        $description = $this->translationProvider->translateForCurrentLanguage(
            $dbPopupNotificationEntity->getCode(),
            DomainEnum::POPUP_NOTIFICATION_TEXT
        );

        return new BusinessPopupNotification(
            $dbPopupNotificationEntity->getId(),
            $dbPopupNotificationEntity->getCode(),
            $dbPopupNotificationEntity->getType(),
            $title,
            $description
        );
    }
}
