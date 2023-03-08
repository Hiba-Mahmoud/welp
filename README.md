WebSite:https://welpbackapis.herokuapp.com/
># Files U Must install
- PHP: https://www.php.net/downloads.php
- Node.js: https://nodejs.org/en
- Composer: https://getcomposer.org

># How To Install and Run? (Linux/Windows)
```
git clone https://github.com/Karl-KLT/Welp-Back.git;cd Welp-Back;composer install;composer update;npm install;npm update;cp .env.example .env;php artisan key:generate;php artisan jwt:secret;php artisan serve
```
># How To Run? (Linux/Windows)
```
php artisan serve
```
## Routes
# collection will be upload here soon
<!-- - Auth
    - Login
        - [POST (body)] require: email, password
        - (success)> return: data, status, message
        - (failed)> return: status, message
    - verifyEmail
        - [POST (body)] require: user_id
        - (success)> return: status, message
        - (failed)> return: status, message
    - updateOrCreate
        - [POST (body)] require: name, email, password (for update (not required))> id (user_id)
        - (success)> return: status, message
        - (failed)> return: status, message
        

- Category:
    - [GET] /
        - (success)> return: data, status, message
   - [GET] /withPagination
        - (success)> return: data, status, message
    - [POST (body)] /updateOrCreate
        - [POST (body)] require: title, image (for update (not required))> id (categury_id)
        - (success)> return: status, message
        - (failed)> return: status, message
    - [GET] /{id}
        - (success)> return: data, status, message
        - (failed)> return: status, message
- Place:
    - [GET] /
        - (success)> return: data, status, message
    - [GET] /withPagination
        - (success)> return: data, status, message
    - [POST (ody)] /updateOrCreate
        - will be edit soon 
    - [GET] /{id}
        - (success)> return: data, status, message
        - (failed)> return: status, message

- Favorite
    - [GET] get/{user_id}
        - (success)> return: data, status, message

    - [POST (body)] create
        - [POST (body)] require: place_id
        - (success)> return: data, status, message
        - (failed)> return: status, message
    - delete
        - [POST (body)] require: favorite_id
        - (success)> return: status, message
        - (failed)> return: status, message
- Review (soon)
    - [GET] get/{user_id}
    - [GET] Review
    - [POST (body)] delete
    
- Search
    - [GET] SearchByGet/{Query?}
        - (success)> return: data, status, message
        - (failed)> return: status, message
    - [POST (body)] SearchByPost
        - (require): Query
        - (success)> return: data, status, message
        - (failed)> return: status, message -->
