## Installation

Please note this is only tested with PHP 8.1 and follow the mentioned steps to set up the project

1. Run `composer install` to install php packages
2. Please update the `.env` file with correct values
3. Finally, run `php artisan db:seed` to seed the product data

After above steps if you request GET `/api/products` you should see a JSON response of the products 

## Testing

```bash
composer test
```
