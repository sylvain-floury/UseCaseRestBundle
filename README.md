FlosyUseCaseRestBundle
======================

Installation
------------

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
