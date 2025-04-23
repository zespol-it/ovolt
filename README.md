# Order Management System API

A simple order management system built with Symfony 6.4 and API Platform. This system allows managing customer orders through a RESTful API.

## Features

- Create new orders with multiple items
- Retrieve order details
- Update order status with validation
- List all orders with filtering and sorting
- Status transition validation (e.g., can't go from "new" to "shipped")
- Data fixtures for testing
- Unit tests

## Technical Stack

- PHP 8.3+
- Symfony 7.2
- API Platform
- Doctrine ORM
- SQLite database
- PHPUnit for testing

## Installation

1. Clone the repository:
```bash
git clone [repository-url]
cd [project-directory]
```

2. Install dependencies:
```bash
composer install
```

3. Set up the database:
```bash
php bin/console doctrine:schema:create
```

4. (Optional) Load test data:
```bash
php bin/console doctrine:fixtures:load
```

5. Start the Symfony development server:
```bash
php -S localhost:8000 -t public/
```

## API Endpoints

### 1. Create Order
```bash
POST /api/orders
Content-Type: application/ld+json

{
  "items": [
    {
      "productId": "1",
      "productName": "Test Product",
      "price": "100.00",
      "quantity": 2
    }
  ]
}
```

### 2. Get All Orders
```bash
GET /api/orders
```

Filtering and sorting options:
- Filter by status: `GET /api/orders?status=paid`
- Sort by creation date: `GET /api/orders?order[createdAt]=desc`

### 3. Get Single Order
```bash
GET /api/orders/{id}
```

### 4. Update Order Status
```bash
PATCH /api/orders/{id}
Content-Type: application/merge-patch+json

{
  "status": "paid"
}
```

## Order Status Flow

The system implements the following status transitions:
- `new` → `paid`, `cancelled`
- `paid` → `shipped`, `cancelled`
- `shipped` → `cancelled`
- `cancelled` → (no further transitions allowed)

## Data Model

### Order
- `id` (UUID)
- `createdAt` (DateTime)
- `status` (string: new, paid, shipped, cancelled)
- `items` (Collection of OrderItem)
- `total` (decimal)

### OrderItem
- `id` (int)
- `productId` (string)
- `productName` (string)
- `price` (decimal)
- `quantity` (int)

## Testing

Run the test suite:
```bash
php bin/phpunit
```

## API Documentation

Access the API documentation at: 

## Development

### Adding New Features

1. Create new entities in `src/Entity/`
2. Create migrations:
```bash
php bin/console make:migration
```

3. Apply migrations:
```bash
php bin/console doctrine:migrations:migrate
```

### Running Tests

1. Unit tests:
```bash
php bin/phpunit tests/Entity
```

2. Load test fixtures:
```bash
php bin/console doctrine:fixtures:load
```

## Security

- Input validation is implemented for all endpoints
- Status transitions are validated
- Decimal values are properly handled for prices

## Error Handling

The API returns appropriate HTTP status codes:
- 200: Success
- 201: Resource created
- 400: Invalid input
- 404: Resource not found
- 415: Unsupported media type
- 422: Unprocessable entity (validation failed)

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a new Pull Request

## License

[Your License Here]