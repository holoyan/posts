<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Table of Content

 - [Introduction](#introduction)
 - [Requirement](#requirement)
 - [Installation](#installation)
 - [Laravel scout setup](#scout)
 - [Usage](#usage)
 - [License](#license) 


 ## Introduction 
 
Develop a Laravel API featuring a Post model. 

The Post model is restricted to the following fields: `id, user_id, title, body, is_published (boolean), created_at, and updated_at`.

The application is equipped with two endpoints:

* Create Post Endpoint:

    * Endpoint: POST /post
    * Purpose: Create new posts using this endpoint.
    * Search Posts Endpoint:

Endpoint: `GET /user/{userId}/posts/search?term={abc}&is_published=1`

Purpose: Retrieve a paginated list of posts based on specified criteria.
Parameters:
`{userId}`: The ID of the user whose posts are being searched.
term: The search term to filter posts.
is_published: Boolean parameter indicating whether to include only published posts (1 for true, 0 for false).

Search Functionality:

Upon the creation of each post, the system should automatically indexes it.
Utilize Laravel Scout for the indexing part with any engine of your choice.
Retrieving the data should also be utilizing ***Laravel Scout***.
The `/user/{userId}/posts/search` endpoint returns a paginated list of posts only if they meet the specified criteria of matching the search term, user ID, and published status.
This setup ensures a streamlined process for creating posts and an efficient search mechanism that considers user-specific criteria, term matching, and publication status.



## Requirement

PHP >= 8.1
   
 
 ## Installation
    git clone git@github.com:holoyan/posts.git
    cd posts
    composer install
    cp .env.example .env
    php artisan key:generate
    // set db credentials
    php artisan migrate
    
    php artisan serve 
    
## Scout

As a [Laravel Scout](https://laravel.com/docs/10.x/scout) driver used [tntsearch](https://github.com/teamtnt/laravel-scout-tntsearch-driver)
Make sure you have proper permission for `storage` folder
> Important: "storage" settings marks the folder where all of your indexes will be saved so make sure to have permission to write to this folder otherwise you might expect the following exception thrown:
  [PDOException] SQLSTATE[HY000] [14] unable to open database file *


if you need fuzzy match set `TNTSEARCH_FUZZINESS=true` in .env file
if you want to use `queue` for indexing, setup queue driver...

    
 ## Usage
 
 To create post use 
 
 
 ```
curl --location --request POST 'http://<DOMAIN>/api/posts' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data-raw '{
  "user_id": 3,
  "title": "Aut voluptates non est quisquam voluptatibus voluptas qui id.",
  "body": "Officia ea omnis omnis ad. Reiciendis quia et fuga corporis distinctio. Quo ad facilis natus est sapiente cupiditate praesentium. Placeat fugiat et ut eum enim error nisi odit.",
  "is_published": true
}'

```

to perform search use

```
curl --location --request GET 'http://<DOMAIN>/api/users/3/posts/search?term=Reiciendis&is_published=0' \
--header 'Accept: application/json'
```

You can pass `perPage` and `page` query params to customize response page and length
If you need to customize response structure check `app\Http\Resources\Posts\PostResource.php` file. For more info check [docs](https://laravel.com/docs/10.x/eloquent-resources) 
 
## License

MIT
