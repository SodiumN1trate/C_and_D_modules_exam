# Setup

Install packages
```sh
composer i --ignore-platform-reqs
```

Run sail
```sh
./vendor/bin/sail artisan up -d
```

Run migrations with seeder
```sh
./vendor/bin/sail artisan migrate --seed
```
