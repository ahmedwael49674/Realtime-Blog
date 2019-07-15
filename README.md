# Realtime-Blog
 ![alt text](https://github.com/ahmedwael49674/Realtime-Blog/blob/master/diagrames/view.JPG)
## Summary
It's a system that allows publishing posts among the users and interact with these posts using (Real-time) comments and provides the user with the ability to edit, remove and change the status of his own posts between published or draft,<br>
Also, the system provides a fully controlling over your profile within the user image, name, password and email  .

## Used technologies
1. Laravel
2. Vue.js
3. Pusher
4. Laravel Echo 

## Features
1. The user can control his own profile image, name, password and email using edit profile page.
2. The user can create, edit and remove posts.
3. The user can add comments over any post and retrieve the others comments in Real-Time.
4. The user can index all of his posts using the posts index page.

## Description
### Sequence  diagram 
 ![alt text](https://github.com/ahmedwael49674/Realtime-Blog/blob/master/diagrames/Sequence%20Diagram.jpg)
1. When the user opens the posting page the connection with pusher is automatically established over Private channel.
2. The sender adds a new comment the request to CommentController with the postId, CommentBody and user API token (which is necessary to the API middleware to make sure this is real user over the system).
3. CommentController will send the comment body to the database to store it.
4. CommentController will call the event newComment which will broadcast the data over the channel.
5. CommentController will return the comment in JSON format to the sender.
6. Vue.js in sender side will unshift the comment to the comments array which bind it over the sender view an empty comment box.
7. The receiver will receive the event which has been broadcasted over the channel. 
8. Vue.js push the data through the object messages which will automatically bind over the view.

### ERD  diagram 
 ![alt text](https://github.com/ahmedwael49674/Realtime-Blog/blob/master/diagrames/ERD.png)
 1. users: store all the user's data within the system.
 2. posts: store the post data with user_id which is foreign key from users table over One-To-Many relationship.
 3. comments: store the comment body with two foreign keys they are the user_id which referrer to the comment owner over One-To-Many relationship with table users and post_id which referee to the post over One-To-Many relationship with table posts
 
## How to run?
before the steps make sure you have an account over pusher (https://pusher.com/) and from the dashboard, you will get all credentials 
1. git clone the project
2. composer install
3. npm install
4. create the database
5. copy .env.exmple to .env and change database credentials and pusher credentials such (PUSHER_APP_ID, PUSHER_APP_KEY, etc..)
6. run the migrations (php artisan migrate)
7. run the seeder (php artisan db:seed)
9. run the project (php artisan serve)
