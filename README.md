# Book-store-packt-assessment


This is the backend for book-store pack assessment test.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.


### Installing

```
1.Clone to local reposatry from main branch
2.Run "composer i" command - to install depandancy
4.Run migrations by "php artisan migrate"
5.Run "php artisan serve" command - to start server
6.Run "php artisan storage link" command - to connect storage to public folder for images
-- I have also uploaded the .env file for the easiness to testing.
```
### After configuring the project 
Now you should be seeing below screen 
![image](https://user-images.githubusercontent.com/99594669/223336859-3eaf0a27-fa74-4856-bf96-b3297c61ba6d.png)


### Api endpoints for admin:
note: All the routes apart from (register and login) needs csrf token for access.

| HTTP Verbs | Endpoints | Action |
| --- | --- | --- |
| POST | /api/register | To sign up a new user account |
| POST | /api/login | To login an existing user account |
| POST | api/book | To create a new book |
| GET | /api/causes | To retrieve all books on the platform |
| GET | api/book/{book} | To retrieve details of a single book |
| PATCH/PUT | api/book/{book} | To edit the details of a single book |
| DELETE | api/book/{book} | To delete a book cause | 


### Api endpoints for user:

| HTTP Verbs | Endpoints | Action |
| --- | --- | --- |
| GET | /api/index | To retrieve all books on the platform |
| GET | api/show/{book:id} | To retrieve details of a single book |

### How to add filters and search on index api
    1."http://127.0.0.1:8000/api/index"
    -> It will gives listing of all books in json format
    -> you can modify this for searching and filtering functionalities like below:
    -> for search "http://127.0.0.1:8000/api/index?search=abc" : It will return all the data which contain abc word in it.
    -> for filter "http://127.0.0.1:8000/api/index?author=riya" : It will return all the data which has riya as a author. like this you can apply all the filters through url.
    -> If you want to add both in a single request then: "http://127.0.0.1:8000/api/index?search=abc&author=riya" : 
    It will give data where author is riya and has abc in its fields.
    
    
