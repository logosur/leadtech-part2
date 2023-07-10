# LeadTech part2 test
Create a custom user management and show userId to checkout that user is updated in the second form submit.

# Environment
- PHP 8.2.3
- Symfony 6.

# Installation
Windows:
```docker/install.bat```

Linux/Unix:
```docker/install.sh```

This will install docker stack for environment, including apache, mysql, php8, postgres.
To run docker container for app/php:
```docker/docker_run.sh```

Once in the php container:
To install symfony project and init database.
```make install```
To start symfony serve instance
```make run```

# Frontend
App can be tested in:
```http://127.0.0.1:8082/user```

# Unit tests
`php ./vendor/bin/phpunit`

# Code syntax checkings
`composer stan`

`composer cs`
