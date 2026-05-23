# krasnoludek — Apache + PHP + MariaDB + phpMyAdmin (Docker Compose)

This repository provides a local development stack implemented with Docker Compose:

- Apache with PHP (serving files from htdocs/)
- MariaDB database server (service name: `db`)
- phpMyAdmin for database administration

## Overview
The Compose stack is designed for easy local development and testing. Services run in a Docker network so the webserver, database, and phpMyAdmin can communicate via service hostnames.

## Hosts & Ports
- Apache + PHP (web): http://localhost:80
  - Document root: htdocs/ (includes index.php and db_test.php)
- phpMyAdmin UI: http://localhost:81

## Database access
- Service host (from other containers): `db`
- User: `root`
- Password: `admin`
- Port: `3306`

Use the `db` hostname from inside other containers (PHP/Apache) to reach MariaDB. From the host machine prefer phpMyAdmin (http://localhost:81) or map the DB port in Compose if direct access is required.

## Quick start
Prerequisites: Docker & Docker Compose

1. From the repository root run:

   docker-compose up -d

2. Open the application: http://localhost (or http://localhost:80)
3. Open phpMyAdmin: http://localhost:81 and log in with `root` / `admin`
4. Test DB connectivity from the webserver: http://localhost/db_test.php (should return "Connected to MariaDB successfully.")

## Useful commands
- Start services: docker-compose up -d
- Stop and remove containers: docker-compose down
- Stream logs: docker-compose logs -f
- Shell into the web container: docker-compose exec web bash
- Run a MySQL command in the DB container:

  docker-compose exec db mysql -u root -padmin -e "SHOW DATABASES;"

## Troubleshooting
- If phpMyAdmin cannot connect, verify the `db` service is healthy and listening on 3306.
- Check container logs: docker-compose logs db web phpmyadmin
- If files are not served, verify permissions for htdocs/ and that Apache has been restarted.

## Security notes
This setup is intended for local development only. The `root` password (`admin`) is insecure and should be changed before any public or production use. Create dedicated database users and restrict access in production environments.

---
If any details are missing (different ports, service names, or additional services), specify the changes and the README will be updated.