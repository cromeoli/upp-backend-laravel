#!/bin/bash

sudo apt-get install composer install
sudo apt-get install php8.1-curl
sudo apt-get install php-dom

echo "================================"
echo "Realizando composer install..."
echo "================================"

composer install

echo "================================"
echo "Renombrando .env.example a .env"
echo "================================"

cp .env.example .env

# Iniciar los contenedores de Sail
./vendor/bin/sail up -d

# Lista de contenedores a comprobar
containers=(
  "upp-backend-laravel-laravel.test-1"
  "upp-backend-laravel-phpmyadmin-1"
  "upp-backend-laravel-selenium-1"
  "upp-backend-laravel-mysql-1"
  "upp-backend-laravel-meilisearch-1"
  "upp-backend-laravel-redis-1"
  "upp-backend-laravel-mailpit-1"
)

# Variable para verificar si todos los contenedores están activos
all_containers_running=false

# Esperar hasta que todos los contenedores estén corriendo
while [ "$all_containers_running" = false ]; do
  # Comprueba el estado de cada contenedor
  for container in "${containers[@]}"; do
    container_status=$(docker inspect -f '{{.State.Running}}' "$container" 2>/dev/null)

    if [ "$container_status" == "true" ]; then
      echo "El contenedor $container está corriendo."
    else
      echo "El contenedor $container no está corriendo."
      all_containers_running=false
      break
    fi

    # Cambia la variable a true si todos los contenedores están activos
    all_containers_running=true
  done

  # Espera 1 segundo antes de volver a comprobar
  sleep 1
done

# Verifica si todos los contenedores están activos
if [ "$all_containers_running" = true ]; then
  echo "================================"
  echo "Contenedores activos, realizando migraciones."
  echo "================================"

  sleep 2
  cd ..
  cd upp-backend-laravel/

  ./vendor/bin/sail artisan migrate

else
  echo "No todos los contenedores están activos."
fi

./vendor/bin/sail artisan key:generate
