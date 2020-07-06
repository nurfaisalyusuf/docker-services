#!/bin/bash
# Basic if statement

echo "Running Services ${1}"

case $1 in

  mongo)
    echo "Create Mongo Services"
    docker stack deploy --with-registry-auth  -f ./mongo/docker-compose.yml db
    ;;

  *)
    echo "unknown"
    ;;
esac