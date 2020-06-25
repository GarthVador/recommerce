# Recommerce

Interview related test

## Requirements

* [PHP](https://php.net) >= 7.4
* [PostgreSQL](http://www.postgresqlfr.org)
* [Composer](https://getcomposer.org)
* [Symfony application requirements](https://symfony.com/doc/current/reference/requirements.html)

## Installation

* Clone project

```shell script
 git clone https://github.com/GarthVador/recommerce.git
```

* Install PHP libraries

```shell script
composer install
```

* Configure .env

```shell script
cp .env .env.local
vim env.local
```

* Prepare database

```shell script
php bin/console doctrine:database:create
php bin/console doctrine:migration:migrate
```

* Launch server (local environnment only)

```shell script
symfony server start
```

Then API is reachable on `http://localhost:8000`

## Endpoint

### Brands

* List brands

```json
GET /api/brands

+ Response 200 (application/json)

[
  {
    "id": 1,
    "name": "brand_1"
  },
  {
    "id": 2,
    "name": "brand_2"
  },
  {
    "id": 3,
    "name": "brand_3"
  }
]
```

* Fetch one brand

```json
GET /api/brands/{brand_id}

+ Response 200 (application/json)

{
  "id": 1,
  "name": "brand_1"
}
```

### Products

* List products

```json
GET /api/products

+ Response 200 (application/json)

[
  {
    "id": 1,
    "brand": {
      "id": 1,
      "name": "brand_1"
    },
    "name": "product_1",
    "price": 3.5
  },
  {
    "id": 2,
    "brand": {
      "id": 1,
      "name": "brand_1"
    },
    "name": "product_2",
    "price": 42
  },
  {
    "id": 3,
    "brand": {
      "id": 2,
      "name": "brand_2"
    },
    "name": "product_3",
    "price": 7.96
  }
]
```

* Fetch one product

```json
GET /api/products/{product_id}

+ Response 200 (application/json)

{
  "id": 1,
  "brand": {
    "id": 1,
    "name": "brand_1"
  },
  "name": "product_1",
  "price": 3.5
}
```

### Orders

* List orders

```json
GET /api/orders

+ Response 200 (application/json)

[
  {
    "id": 1,
    "mobiles": [
      {
        "id": 1,
        "brand": {
          "id": 1,
          "name": "brand_1"
        },
        "name": "product_1",
        "price": 3.5
      },
      {
        "id": 2,
        "brand": {
          "id": 1,
          "name": "brand_1"
        },
        "name": "product_2",
        "price": 42
      }
    ],
    "customerEmail": "example@test.fr",
    "amount": 45.5,
    "created": "2020-06-25T17:00:00+00:00"
  },
  {
    "id": 2,
    "mobiles": [
      {
        "id": 1,
        "brand": {
          "id": 1,
          "name": "brand_1"
        },
        "name": "product_1",
        "price": 3.5
      },
      {
        "id": 2,
        "brand": {
          "id": 1,
          "name": "brand_1"
        },
        "name": "product_2",
        "price": 42
      },
      {
        "id": 3,
        "brand": {
          "id": 2,
          "name": "brand_2"
        },
        "name": "product_3",
        "price": 7.96
      }
    ],
    "customerEmail": "example@test.fr",
    "amount": 53.46,
    "created": "2020-06-25T18:00:00+00:00"
  }
]
```

* Fetch one order

```json
GET /api/order/{order_id}

+ Response 200 (application/json)

{
  "id": 2,
  "mobiles": [
    {
      "id": 1,
      "brand": {
        "id": 1,
        "name": "brand_1"
      },
      "name": "product_1",
      "price": 3.5
    },
    {
      "id": 2,
      "brand": {
        "id": 1,
        "name": "brand_1"
      },
      "name": "product_2",
      "price": 42
    },
    {
      "id": 3,
      "brand": {
        "id": 2,
        "name": "brand_2"
      },
      "name": "product_3",
      "price": 7.96
    }
  ],
  "customerEmail": "example@test.fr",
  "amount": 53.46,
  "created": "2020-06-25T18:00:00+00:00"
}
```

* Create order (Not working right now ...)

```json
POST /api/orders

Body:
{
	"customerEmail": "example@test.fr",
	"mobiles": [1, 2]
}

+ Response 204 (no content)
```


