# 1. First, remove the current vendor directory and composer files to start fresh
rm -rf vendor composer.lock

# 2. Create new Symfony project (this will create all necessary directories and files)
composer create-project symfony/skeleton:"6.4.*" temp
mv temp/* temp/.* . 2>/dev/null
rmdir temp

# 3. Install required dependencies
composer require api
composer require symfony/uid
composer require symfony/orm-pack
composer require symfony/validator
composer require --dev symfony/maker-bundle

# 4. Install API Platform
composer require api-platform/core

# 5. Install Doctrine ORM
composer require symfony/orm-pack

# 6. Install Doctrine Migrations
composer require doctrine/migrations

# 7. Install Doctrine DBAL
composer require doctrine/dbal

# 8. Install Symfony Maker Bundle
composer require --dev symfony/maker-bundle

# 9. Install Symfony Security Bundle
composer require symfony/security-bundle

# 10. Install Symfony Serializer
composer require symfony/serializer

# 11. Install Symfony HttpClient
composer require symfony/http-client

# 12. Install Symfony Mailer
#composer require symfony/mailer

# 13. Install Symfony Messenger
#composer require symfony/messenger

# 14. Install Symfony Security Bundle
composer require symfony/security-bundle

# 15. Install Symfony Serializer
composer require symfony/serializer

