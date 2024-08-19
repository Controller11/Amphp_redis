# Amphp_redis

It's docker-compose app example with two containers within: PHP and Redis.
Inside PHP container runs index.php script, which utilizes one CPU core for 100% making random amphp/redis writes with amphp LOOP.

## How to run

```bash
docker-compose build
```

```bash
docker-compose up
```

```bash
docker-compose exec php php /app/index.php
```