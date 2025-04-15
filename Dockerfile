FROM php:8.2-cli
COPY . /usr/src/tree_queries
WORKDIR /usr/src/tree_queries
CMD [ "php", "./tree_queries.php" ]
