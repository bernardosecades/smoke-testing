## Docker Quickstart Guide

- [Install Docker](#install-docker)
- [Build container](#build-container)
- [Launch it :-)](#launching-containers)
- [Common Operations](#common-tasks)

<a name="install-docker"></a>
###Install Docker

Installing Docker on ubuntu
```bash
apt-get update
apt-get install -y wget
wget -qO- https://get.docker.com/ | sh
```
Checking Docker version
```bash
docker --version
```


<a name="build-container"></a>
###Build containers

```bash
docker-compose build
```
This command will build the container with all its dependencies

<a name="launching-containers"></a>
###Launch it 
```bash
docker-compose up -d
```

<a name="common-tasks"></a>
###Common Operations

Checking if containers are running
```bash
docker ps
```
Accessing the workspace 
```bash
docker-compose exec php bash
```
Stopping the containers
```bash
docker-compose down
```