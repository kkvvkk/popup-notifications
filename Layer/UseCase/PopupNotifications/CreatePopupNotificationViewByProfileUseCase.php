<?php

namespace Layer\UseCase\PopupNotifications;

use Exception;
use Layer\Domain\AppServices\ProfileSelector\GetSelectedProfileIdInterface;
use Layer\Domain\Exceptions\AccessDeniedException;
use Layer\Domain\Exceptions\NotFoundException;
use Layer\Domain\PopupNotifications\CreatePopupNotificationViewByProfileInterface;
use Layer\Domain\PopupNotifications\GetOneActivePopupNotificationByCodeInterface;
use Layer\Domain\PopupNotifications\IsPopupNotificationWasViewedByProfileInterface;
use Layer\Domain\PopupNotifications\PopupNotificationViewByProfileFactory;

class CreatePopupNotificationViewByProfileUseCase
{
    private GetOneActivePopupNotificationByCodeInterface $getActivePopupNotificationByCode;
    private CreatePopupNotificationViewByProfileInterface $createPopupNotificationViewByProfile;
    private IsPopupNotificationWasViewedByProfileInterface $isPopupNotificationWasViewedByProfile;
    private GetSelectedProfileIdInterface $getSelectedProfileId;
    private PopupNotificationViewByProfileFactory $popupNotificationViewByProfileFactory;

    public function __construct(
        GetOneActivePopupNotificationByCodeInterface $getActivePopupNotificationByCode,
        CreatePopupNotificationViewByProfileInterface $createPopupNotificationViewByProfile,
        IsPopupNotificationWasViewedByProfileInterface $isPopupNotificationWasViewedByProfile,
        GetSelectedProfileIdInterface $getSelectedProfileId,
        PopupNotificationViewByProfileFactory $popupNotificationViewByProfileFactory
    ) {
        $this->getActivePopupNotificationByCode = $getActivePopupNotificationByCode;
        $this->createPopupNotificationViewByProfile = $createPopupNotificationViewByProfile;
        $this->isPopupNotificationWasViewedByProfile = $isPopupNotificationWasViewedByProfile;
        $this->getSelectedProfileId = $getSelectedProfileId;
        $this->popupNotificationViewByProfileFactory = $popupNotificationViewByProfileFactory;
    }

    /**
     * @throws NotFoundException|AccessDeniedException
     */
    public function create(string $popupNotificationCode): void
    {
        try {
            $selectedProfileId = $this->getSelectedProfileId->get();
        } catch (Exception $exception) {
            throw new AccessDeniedException();
        }

        $activePopupNotification = $this->getActivePopupNotificationByCode->get($popupNotificationCode);

        $popupNotificationViewByProfile = $this->popupNotificationViewByProfileFactory->make(
            $activePopupNotification->getId(),
            $selectedProfileId
        );

        if (
            $this->isPopupNotificationWasViewedByProfile->is($popupNotificationViewByProfile)
        ) {
            throw new NotFoundException();
        }

        $this->createPopupNotificationViewByProfile->run($popupNotificationViewByProfile);
    }
}
