docker-compose -f docker-compose.yml up -d --build --force-recreate --remove-orphan
docker exec -ti docker_php82_1 bash -c '/usr/bin/make install && /usr/bin/make run'
