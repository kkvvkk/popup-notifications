<?php

namespace Layer\Persistence\Action\PopupNotifications;

use Layer\Domain\PopupNotifications\Entity\PopupNotificationViewByProfile;
use Layer\Domain\PopupNotifications\IsPopupNotificationWasViewedByProfileInterface;
use Layer\Persistence\Model\PopupNotifications\PopupNotificationViewByProfileModel;
use Layer\Persistence\Repository\PopupNotifications\PopupNotificationsProfilesRepository;

class IsPopupNotificationWasViewedByProfileAction implements IsPopupNotificationWasViewedByProfileInterface
{
    private PopupNotificationsProfilesRepository $popupNotificationsProfilesRepository;
    private PopupNotificationViewByProfileModel $popupNotificationViewByProfileModel;

    public function __construct(
        PopupNotificationsProfilesRepository $popupNotificationsProfilesRepository,
        PopupNotificationViewByProfileModel $popupNotificationViewByProfileModel
    ) {
        $this->popupNotificationsProfilesRepository = $popupNotificationsProfilesRepository;
        $this->popupNotificationViewByProfileModel = $popupNotificationViewByProfileModel;
    }

    public function is(PopupNotificationViewByProfile $popupNotificationViewByProfile): bool
    {
        return $this->popupNotificationsProfilesRepository->isPopupNotificationWasViewedByProfile(
            $this->popupNotificationViewByProfileModel->fromDomain(
                $popupNotificationViewByProfile
            )
        );
    }
}
