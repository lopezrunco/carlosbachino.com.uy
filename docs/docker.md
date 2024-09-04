## Run via Docker:

### 1. Install Docker
Ensure Docker is installed on your system. You can download Docker from the <a href="https://www.docker.com/" target="_blank">official Docker website</a>.

### 2. Create a Docker Compose File
Create a docker-compose.yaml file in your project directory with the following content:

```yml
    version: '1'

    services:
    # Database
    db:
        image: mysql:5.7
        volumes:
        - db_data:/var/lin/mysql
        restart: always
        environment: 
        MYSQL_ROOT_PASSWORD: password
        MYSQL_DATABASE: wordpress
        MYSQL_USER: wordpress
        MYSQL_PASSWORD: wordpress
        networks:
        - wpsite
    # Phpmyadmin
    phpmyadmin:
        depends_on:
        - db
        image: phpmyadmin/phpmyadmin
        restart: always
        ports:
        - '8080:80'
        environment:
        PMA_HOST: db
        MYSQL_ROOT_PASSWORD: password
        networks:
        - wpsite
    # Wordpress
    wordpress:
        depends_on:
        - db
        image: wordpress:latest
        ports:
        - '8000:80'
        restart: always
        volumes: ['./:/var/www/html']
        environment:
        WORDPRESS_DB_HOST: db:3306
        WORDPRESS_DB_USER: wordpress
        WORDPRESS_DB_PASSWORD: wordpress
        networks:
        - wpsite
    networks:
    wpsite:
    volumes:
    db_data:
```

### 3. Start the Docker Container
```sh
    docker-compose up -d
```
This command will download the required Docker images and start the containers.

### 4. Access the WordPress Installation
Once the containers are up and running, you can access the WordPress installation by navigating to http://localhost:8000 in your web browser.

### 5. Complete the WordPress Installation
Follow the on-screen instructions to complete the WordPress installation.

### 6. Manage Your Docker Containers
To list all running containers:
```sh
    docker ps
```
To list all containers (running and stopped):
```sh
    docker ps -a
```
To start a container:
```sh
    docker start <container_id_or_name>
```