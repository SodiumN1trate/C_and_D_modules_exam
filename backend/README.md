# Setup

Install packages
```sh
composer i --ignore-platform-reqs
```

Set .env
```sh
cp .env.example .env
```

Build with sail
```sh
./vendor/bin/sail build --no-cache
```

Run sail
```sh
./vendor/bin/sail up -d
```

Run migrations with seeder
```sh
./vendor/bin/sail artisan migrate --seed
```

### Congrats!
