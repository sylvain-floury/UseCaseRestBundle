FlosyUseCaseRestBundle
======================

Installation
------------

```php
// app/AppKernel.php
$bundles = array(
    //...
    new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
    new FOS\RestBundle\FOSRestBundle(),
    new JMS\SerializerBundle\JMSSerializerBundle(),
```
```json
# /composer.json
    "require": {
        #...
        "stof/doctrine-extensions-bundle": "dev-master",
```

```yaml
# /app/config/routing.yml
flosy_usecase_rest:
    type: rest
    prefix: /api
    resource: "@FlosyUseCaseRestBundle/Resources/config/routing.yml"
```

Dependencies
------------

```bash
php composer.phar require "friendsofsymfony/rest-bundle" "@dev"
php composer.phar require "jms/serializer-bundle" "@dev"
php composer.phar require "nelmio/api-doc-bundle" "@dev"
```

```php
// app/AppKernel.php
$bundles = array(
    //..
    new FOS\RestBundle\FOSRestBundle(),
    new JMS\SerializerBundle\JMSSerializerBundle(),
    new Nelmio\ApiDocBundle\NelmioApiDocBundle(),
```

https://github.com/FriendsOfSymfony/FOSRestBundle/blob/master/Resources/doc/3-listener-support.md

```yaml
# /app/config/config.yml
stof_doctrine_extensions:
    default_locale: fr_FR
    orm:
        default:
            timestampable: true

fos_rest:
    view:
        view_response_listener: force

sensio_framework_extra:
    view:    { annotations: false }
    router:  { annotations: true }
```

For tests

```bash
php composer.phar require "doctrine/doctrine-fixtures-bundle" "dev-master"
php composer.phar require "liip/functional-test-bundle" "dev-master"
```

```php
// app/AppKernel.php
$bundles = array(
    //...
    new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),

if (in_array($this->getEnvironment(), array('test'))) {
    $bundles[] = new Liip\FunctionalTestBundle\LiipFunctionalTestBundle();
}
```

```yaml
# /app/config/config_test.yml
liip_functional_test: ~
```