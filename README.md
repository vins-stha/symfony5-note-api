# Symfony 5 Note API

Symfony based note API. Provides API endpoints to create, read, update and delete notes.

## Setup

1. Start up powershell/terminal and access the project folder
2. Start up docker compose instance - `docker-compose up --build -d`
3. Gain access to php bash shell - `docker exec -it php bash`
4. Go to root of symfony project - `cd code`
5. Install dependencies - `composer install`
6. Make migrations `php bin/console make:migration`
6. Open site in browser [localhost:8001/api/v1/notes](http://localhost:8001)

## Tasks

1. Copy this repository to your own GitHub account.
2. Add phpmyadmin container to docker compose. Document access in README.md
3. Create Note entity. Note has id, title, created time and text.
4. Make sure to generate migrations for database tables/schema.
5. Write code for all routes in NoteController so that application fulfills CRUD tasks.
   1. `/notes/add` - Add new note.
   2. `/notes/{id}` - Get note by id.
   3. `/notes/{id}` - Put an update to note by id.
   4. `/notes/{id}` - Delete a note by id.
   5. `/notes` - Get all notes ordered by date (The newest first). Add options to limit results, change sorting order and search note by text.
6. Add documentation and comments as needed using best practices.
7. Create Pull Request on your own repository describing changes. Add manual testing scenarios for each functionality in PR.
8. (Optional) Write unit or web tests.
9. Send us a link to your PR.
"# symfony5-note-api" 


## Testing scenarios
   1. `api/v1/notes/add` - Add new note.
   
        Method = [POST].            
        
           {
                "title" : "title-foo",            
                "text": "text-bar",
                "created_time":"2012-01-01 02:02:00"
            }
   2. `api/v1/notes/` - List all notes (ordered by created date)
      
              Method = [GET].
              
              api/v1/notes/
              
           
   3. `api/v1/notes/{id}` - Update note with id = {id}
   
           Method = [PUT].
           
           api/v1/notes/1
           
              {
                   "title" : "title-foo",            
                   "text": "text-bar",
                   "created_time":"2012-01-01 02:02:00"
               }
   4. `api/v1/notes/{id}` - Delete note with id = {id}
      
              Method = [DELETE].
              
              api/v1/notes/1
              
              
   5. `api/v1/notes/{id}` - Find note with id = {id}
      
              Method = [GET].
              
              api/v1/notes/1
              
                 {
                      "title" : "title-foo",            
                      "text": "text-bar",
                      "created_time":"2012-01-01 02:02:00"
                  }
                  
## Unit Testing
1. Gain access to php bash shell - `docker exec -it php bash`
or Enter the terminal

2.  Go to root of symfony project - `cd code`

3. Install GuzzleHttp client  `composer require guzzlehttp/guzzle` 

3. Enter unit testing command `php vendor/bin/phpunit tests/ApiTest.php`

    Results like :
    ##OK (5 tests, 5 assertions)
    
    can be seen for successful action of unit test