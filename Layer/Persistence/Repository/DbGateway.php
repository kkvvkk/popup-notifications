<?php

namespace Layer\Persistence\Repository;

abstract class DbGateway
{
    abstract public function query(string $sqlQuery, ?array $queryParameters = null): void;

    abstract public function fetchSingleRowAssoc(string $sqlQuery, ?array $queryParameters = null): array;

    abstract public function fetchAllRowsAssoc(string $sqlQuery, ?array $queryParameters = null): array;
}
