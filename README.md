# Smoke-testing

Smoke testing package for PHP projects.

## Environment variables

If you want to add smoke testing to check if environment variables are loaded and are not empty 
in your machine you only need extends from class `CheckEnvironment` class:

```php
namespace Tests\SmokeTesting;

use BgSmokeTesting\Environment\CheckEnvironment;

class BgFlashCheckEnvironmentTest extends CheckEnvironment
{
    /**
     * {@inheritdoc}
     */
    public function getEnvPath(): string
    {
        return'{ROOT_PROJECT_PATH}/.env.dist'; // OR .env.development
    }
}
```

And implement the method `getEnvPath()`. If for example in your file `.env.dist`you have 
the variable `DB_CONNECTION` but this is not loaded or is empty the assertion will fail with a message like this:

"Environment variable 'DB_CONNECTION' does not exist" or "Environment variable 'DB_CONNECTION' is empty".

## Composer lock file out of date

If you resolve in bad way conflicts with files composer.json and composer.lock it is necessary ensure your lock file is not out date.

So to add smoke testing to avoid these kind of problems you can extends from class `LockFileOutOfDate` class:

```php
namespace Tests\SmokeTesting;

use BernardoSecades\SmokeTesting\Composer\LockFileOutOfDate;

class MyLockFileOutOfDateTest extends LockFileOutOfDate
{
    /**
     * {@inheritdoc}
     */
    public function getProjectPath(): string
    {
        return'{ROOT_PROJECT_PATH}'; 
    }
}
```

## Check if you have problems in your service container to handle dependency injections

If you are working with frameworks like Symfony, Laravel, Yii, ... you are using a container to handle dependency injections. 
These frameworks are using containers follow [PSR-11](https://www.php-fig.org/psr/psr-11/) so this smoke test ensure your container
is working properly. You can use this smoke testing in any framework follow PSR-11.

Example for `laravel` framework:

```php
namespace Tests\Smoke;

use BernardoSecades\SmokeTesting\ServiceContainer\CheckServiceContainer;
use Psr\Container\ContainerInterface;
use Illuminate\Container\Container;

class MyCheckServiceContainer extends CheckServiceContainer
{
    /**
     * @return Container
     */
    protected function getLaravelContainer(): Container
    {
        return require __DIR__.'/../../bootstrap/app.php';
    }

    /**
     * {@inheritdoc}
     */
    protected function getContainer(): ContainerInterface
    {
        return $this->getLaravelContainer();
    }

    /**
     * {@inheritdoc}
     */
    protected function getAllServiceNames(): array
    {
        $bidings = $this->getLaravelContainer()->getBindings();

        if (empty($bidings)) {
            return [];
        }

        return array_keys($bidings);
    }
}
```  

## Docker Guide
Docker guide helps developers to setup staging/development env in docker.
[Docker guidelines for this project](_guides/docker_guide.md)

## Execute tests

`./vendor/bin/phpnit`
