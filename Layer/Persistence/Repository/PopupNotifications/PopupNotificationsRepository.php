<?php

namespace Layer\Persistence\Repository\PopupNotifications;

use DateTimeImmutable;
use Layer\Persistence\Entity\PopupNotifications\PopupNotificationEntity;
use Layer\Persistence\Repository\DbGateway;

class PopupNotificationsRepository
{
    private const POPUP_NOTIFICATIONS_TABLE_NAME = 'db.table_name';

    private DbGateway $connection;

    public function __construct(DbGateway $connection)
    {
        $this->connection = $connection;
    }

    public function getByCode(string $code): ?PopupNotificationEntity
    {
        $popupNotificationsTableName = self::POPUP_NOTIFICATIONS_TABLE_NAME;

        $sql = <<<SQL
SELECT * FROM $popupNotificationsTableName 
WHERE 
    code = :code
SQL;

        $row = $this->connection->fetchSingleRowAssoc($sql, [
            'code' => $code
        ]);

        return count($row) !== 0 ? $this->makeEntity($row) : null;
    }

    /**
     * @return PopupNotificationEntity[]
     */
    public function getByType(string $type): array
    {
        $popupNotificationsTableName = self::POPUP_NOTIFICATIONS_TABLE_NAME;

        $sql = <<<SQL
SELECT * FROM $popupNotificationsTableName 
WHERE 
    type = :type
SQL;

        $rows = $this->connection->fetchAllRowsAssoc($sql, [
            'type' => $type
        ]);

        $entities = [];
        foreach ($rows as $row) {
            $entities[] = $this->makeEntity($row);
        }

        return $entities;
    }

    private function makeEntity(array $row): PopupNotificationEntity
    {
        return new PopupNotificationEntity(
            $row['id'],
            $row['code'],
            $row['type'],
            new DateTimeImmutable($row['expire_at'])
        );
    }
}
