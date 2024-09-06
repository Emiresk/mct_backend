#!/bin/bash

CONTAINER_NAME="mariadb"
BACKUP_PATH="./backup/db_backup.sql"

echo "Создание бэкапа базы данных..."
# Используем команду mysqldump для бэкапа базы данных
docker exec -t $CONTAINER_NAME mysqldump -u user -puser --databases hostapp > $BACKUP_PATH

echo "Бэкап базы данных успешно создан: $BACKUP_PATH"

docker-compose down