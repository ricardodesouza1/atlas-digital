#!/bin/bash

docker container rm atlas-digital --force
docker image rm atlas-utfpr
docker build -t atlas-utfpr - < Dockerfile
docker run --name atlas-digital -d -p 8082:80 atlas-utfpr
docker exec -it atlas-digital bash -c "service postgresql start"
