<?php

namespace Layer\UseCase\PopupNotifications;

use Exception;
use Layer\Domain\AppServices\ProfileSelector\GetSelectedProfileIdInterface;
use Layer\Domain\Exceptions\AccessDeniedException;
use Layer\Domain\PopupNotifications\Entity\PopupNotification;
use Layer\Domain\PopupNotifications\GetActivePopupNotificationsByTypeInterface;
use Layer\Domain\PopupNotifications\IsPopupNotificationWasViewedByProfileInterface;
use Layer\Domain\PopupNotifications\PopupNotificationViewByProfileFactory;

class GetActivePopupNotificationsForSelectedProfileByTypeUseCase
{
    private GetActivePopupNotificationsByTypeInterface $getActivePopupNotificationsByType;
    private IsPopupNotificationWasViewedByProfileInterface $isPopupNotificationWasViewedByProfile;
    private GetSelectedProfileIdInterface $getSelectedProfileId;
    private PopupNotificationViewByProfileFactory $popupNotificationViewByProfileFactory;

    public function __construct(
        GetActivePopupNotificationsByTypeInterface $getActivePopupNotificationsByType,
        IsPopupNotificationWasViewedByProfileInterface $isPopupNotificationWasViewedByProfile,
        GetSelectedProfileIdInterface $getSelectedProfileId,
        PopupNotificationViewByProfileFactory $popupNotificationViewByProfileFactory
    ) {
        $this->getActivePopupNotificationsByType = $getActivePopupNotificationsByType;
        $this->isPopupNotificationWasViewedByProfile = $isPopupNotificationWasViewedByProfile;
        $this->getSelectedProfileId = $getSelectedProfileId;
        $this->popupNotificationViewByProfileFactory = $popupNotificationViewByProfileFactory;
    }

    /**
     * @param string $popupType
     *
     * @return PopupNotification[]
     *
     * @throws AccessDeniedException
     */
    public function get(string $popupType): array
    {
        try {
            $selectedProfileId = $this->getSelectedProfileId->get();
        } catch (Exception $exception) {
            throw new AccessDeniedException();
        }

        $activePopupNotifications = $this->getActivePopupNotificationsByType->get($popupType);

        $notViewedActivePopupNotifications = [];

        foreach ($activePopupNotifications as $activePopupNotification) {
            if (
                $this->isPopupNotificationWasViewedByProfile->is(
                    $this->popupNotificationViewByProfileFactory->make(
                        $activePopupNotification->getId(),
                        $selectedProfileId
                    )
                ) === false
            ) {
                $notViewedActivePopupNotifications[] = $activePopupNotification;
            }
        }

        return $notViewedActivePopupNotifications;
    }
}
