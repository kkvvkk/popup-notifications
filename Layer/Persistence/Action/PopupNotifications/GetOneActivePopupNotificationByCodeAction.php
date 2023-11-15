<?php

namespace Layer\Persistence\Action\PopupNotifications;

use DateTimeImmutable;
use Layer\Domain\Exceptions\NotFoundException;
use Layer\Domain\PopupNotifications\Entity\PopupNotification;
use Layer\Domain\PopupNotifications\GetOneActivePopupNotificationByCodeInterface;
use Layer\Persistence\Model\PopupNotifications\PopupNotificationModel;
use Layer\Persistence\Repository\PopupNotifications\PopupNotificationsRepository;

class GetOneActivePopupNotificationByCodeAction implements GetOneActivePopupNotificationByCodeInterface
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
     * @throws NotFoundException
     */
    public function get(string $popupCode): PopupNotification
    {
        $popupNotification = $this->popupNotificationsRepository->getByCode($popupCode);

        if (
            $popupNotification === null
            || $popupNotification->getExpireAt() <= new DateTimeImmutable("now")
        ) {
            throw new NotFoundException();
        }

        return $this->popupNotificationModel->toBusiness($popupNotification);
    }
}
