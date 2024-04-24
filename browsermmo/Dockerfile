FROM ubuntu:latest
ARG DEBIAN_FRONTEND=noninteractive

WORKDIR /app/frontend

COPY frontend/sql/browsermmo-2.sql /tmp/database.init.sql
COPY docker.init.sh /tmp/docker.init.sh

RUN chmod +x /tmp/docker.init.sh

# Install MariaDB Server
RUN apt-get update && \
    apt-get install -y mariadb-server php8.1 php8.1-mysql && \
    apt-get install -y vim tmux && \
    apt-get clean

# Start the MariaDB service and initialize the database
RUN service mariadb start && \
    mysql < /tmp/database.init.sql

ENTRYPOINT [ "/tmp/docker.init.sh" ]

EXPOSE 80
