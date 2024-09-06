#!/bin/bash
# Восстановление базы данных из бэкапа

CONTAINER_NAME="mariadb"
BACKUP_PATH="./backup/db_backup.sql"

if [ -f $BACKUP_PATH ]; then
    echo "Восстановление базы данных из бэкапа..."
    cat $BACKUP_PATH | docker exec -i $CONTAINER_NAME mysql -u user -puser hostapp
    echo "База данных успешно восстановлена!"
else
    echo "Бэкап не найден, пропускаем восстановление."
fi