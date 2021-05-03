run container where program will be execute
```bash
docker-compose up -d
```
install dependencies in docker container:
```bash
docker exec -ti php sh -c "composer install"
```
run tests in docker container:
```bash
docker exec -ti php sh -c "php bin/phpunit tests"
```
run command in docker container:
```bash
docker exec -ti php sh -c "php application.php --alg-description"
```