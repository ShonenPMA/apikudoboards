# API Kudoboards
[Documentación en español](./README-es.md)
## Summary

  * [Setup](#setup)
  * [API Docs](#api-docs)
  * [Optimize for production env](#optimize-for-production-env)
  
### Setup

1. Clone the repo in a folder(api-kudoboards):

> git clone https://github.com/ShonenPMA/apikudoboards.git  api-kudoboards

2. Go to the folder and run the command below:

 - 2.1 For prod env
    > composer install --optimize-autoloader --no-dev
 - 2.2 For dev env
    > composer install

3. Copy  .env.example to set your env variabless:

> cp .env.example .env

4. Edit .env:

> nano .env

 - 4.1 Important:
   - Set `SANCTUM_STATEFUL_DOMAINS` and `SESSION_DOMAIN` with your FRONTEND APP ENDPOINT

5. Generate key application:

> php artisan key:generate

6. Run migrations

 - 6.1 Only tables 
    > php artisan migrate
 - 6.2 With fake data
    > php artisan migrate --seed

7. Set persmissions to folders bootstrap/cache y storage

> chmod -R 775 boostrap/cache
>
> chmod -R 775 storage

8. Setup the public_html access to your app (Optional)

    8.1. Main project
    > ln -s /home/user/api-kudoboards/public public_html 

    8.2 Secondary project

    > ln -s /home/user/api-kudoboards/public api-kudoboards 

9. Link storage (Optional to store files)

>php artisan storage:link (en el path de tu aplicacion)

### API Docs

To get the endpoints docs run the command below:
> php artisan scribe:generate

After that go to the route : `/docs`

### Optimize for production env

Every time your update the project with new feature, you should run the commands below:

> php artisan config:cache
>
> php artisan route:cache
>
> php artisan view:cache


Optional commands which you should run when:
1. If there are new packages or someone modify composer.sjon file

> composer install --optimize-autoloader --no-dev

2. If there are new migrations

> php artisan migrate