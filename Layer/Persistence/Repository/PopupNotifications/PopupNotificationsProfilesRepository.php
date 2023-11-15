<?php

namespace Layer\Persistence\Repository\PopupNotifications;

use Layer\Persistence\Entity\PopupNotifications\PopupNotificationViewByProfileEntity;
use Layer\Persistence\Repository\DbGateway;

class PopupNotificationsProfilesRepository
{
    private const POPUP_NOTIFICATIONS_PROFILES_TABLE_NAME = 'db.table_name';

    private DbGateway $connection;

    public function __construct(DbGateway $connection)
    {
        $this->connection = $connection;
    }

    public function isPopupNotificationWasViewedByProfile(PopupNotificationViewByProfileEntity $entity): bool
    {
        $popupNotificationsProfilesTableName = self::POPUP_NOTIFICATIONS_PROFILES_TABLE_NAME;

        $sql = <<<SQL
SELECT * FROM $popupNotificationsProfilesTableName 
WHERE 
    notification_id = :notification_id AND
    profile_id = :profile_id
SQL;

        return (bool) $this->connection->fetchSingleRowAssoc($sql, [
            'notification_id' => $entity->getPopupNotificationId(),
            'profile_id' => $entity->getProfileId()
        ]);
    }

    public function insert(PopupNotificationViewByProfileEntity $entity): void
    {
        $popupNotificationsProfilesTableName = self::POPUP_NOTIFICATIONS_PROFILES_TABLE_NAME;

        $sql = <<<SQL
INSERT INTO $popupNotificationsProfilesTableName 
SET 
    notification_id = :notification_id,
    profile_id = :profile_id
SQL;

        $this->connection->query($sql, [
            'notification_id' => $entity->getPopupNotificationId(),
            'profile_id' => $entity->getProfileId()
        ]);
    }
}
