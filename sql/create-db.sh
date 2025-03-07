sed -e "s/\${DB_DATABASE}/$DB_DATABASE/g" /docker-entrypoint-initdb.d/setup.sql | mysql -u"$DB_USERNAME" -p"$DB_PASSWORD"
