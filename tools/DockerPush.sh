#!/bin/bash
cd ..
echo "$DOCKER_PASSWORD" | docker login -u "$DOCKER_USERNAME" --password-stdin
docker build -t ultimaphp .
docker tag ultimaphp hideout/ultimaphp
docker push hideout/ultimaphp
