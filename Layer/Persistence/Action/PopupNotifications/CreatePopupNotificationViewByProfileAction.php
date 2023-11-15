<?php

namespace Layer\Persistence\Action\PopupNotifications;

use Layer\Domain\PopupNotifications\CreatePopupNotificationViewByProfileInterface;
use Layer\Domain\PopupNotifications\Entity\PopupNotificationViewByProfile;
use Layer\Persistence\Model\PopupNotifications\PopupNotificationViewByProfileModel;
use Layer\Persistence\Repository\PopupNotifications\PopupNotificationsProfilesRepository;

class CreatePopupNotificationViewByProfileAction implements CreatePopupNotificationViewByProfileInterface
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

    public function run(PopupNotificationViewByProfile $popupNotificationViewByProfile): void
    {
        $this->popupNotificationsProfilesRepository->insert(
            $this->popupNotificationViewByProfileModel->fromDomain(
                $popupNotificationViewByProfile
            )
        );
    }
}
