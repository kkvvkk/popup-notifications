<?php

namespace Layer\Persistence\Action\PopupNotifications;

use DateTimeImmutable;
use Layer\Domain\PopupNotifications\Entity\PopupNotification;
use Layer\Domain\PopupNotifications\GetActivePopupNotificationsByTypeInterface;
use Layer\Persistence\Model\PopupNotifications\PopupNotificationModel;
use Layer\Persistence\Repository\PopupNotifications\PopupNotificationsRepository;

class GetActivePopupNotificationsByTypeAction implements GetActivePopupNotificationsByTypeInterface
{
    private PopupNotificationsRepository $popupNotificationsRepository;
    private PopupNotificationModel $popupNotificationModel;

    public function __construct(
        PopupNotificationsRepository $popupNotificationsRepository,
        PopupNotificationModel $popupNotificationModel
    ) {
        $this->popupNotificationsRepository = $popupNotificationsRepository;
        $this->popupNotificationModel = $popupNotificationModel;
    }

    /**
     * @param string $popupType
     *
     * @return PopupNotification[]
     */
    public function get(string $popupType): array
    {
        $popupNotifications = $this->popupNotificationsRepository->getByType($popupType);

        $businessEntities = [];

        foreach ($popupNotifications as $popupNotification) {
            if ($popupNotification->getExpireAt() > new DateTimeImmutable("now")) {
                $businessEntities[] = $this->popupNotificationModel->toBusiness($popupNotification);
            }
        }

        return $businessEntities;
    }
}
