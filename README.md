FlosyUseCaseRestBundle
======================

Installation
------------

```php
// app/AppKernel.php
$bundles = array(
    //..
    new FOS\RestBundle\FOSRestBundle(),
    new JMS\SerializerBundle\JMSSerializerBundle(),
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
```

```php
// app/AppKernel.php
$bundles = array(
    //..
    new FOS\RestBundle\FOSRestBundle(),
    new JMS\SerializerBundle\JMSSerializerBundle(),
```

https://github.com/FriendsOfSymfony/FOSRestBundle/blob/master/Resources/doc/3-listener-support.md

```yaml
# /app/config/config.yml
fos_rest:
    view:
        view_response_listener: force

sensio_framework_extra:
    view:    { annotations: false }
    router:  { annotations: true }
```