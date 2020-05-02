# Forgif

Forgif is my old project, this is the Gif social network. The architecture is so bad, there are no migrations, no seeders, or other best practices. But, you can learn a few things in this project, one of them is about business processes and some logic that I made. This project is the history of the first time I used Laravel, the first version of Laravel that I used was 5.2, but, this project was made with Laravel 5.4.

## Requirements
- PHP ^5.6
- PHP's `proc_open`, `proc_close`
- Composer
- [FFmpeg](https://ffmpeg.org/) (Desperately needed; Install it globally – so, PHP can access the `ffmpeg` command globally)
- Email SMTP (For user activation)
- Facebook App Key (Optional)

## Installation
1. Clone this repo
2. Run the `composer install` command 
3. Create your own database
4. Run the `cp .env.example .env`
5. Edit the `.env` file and adjust your database setting
6. Run the `php artisan key:generate`
7. Import the `forgif.sql` file into your database
8. Run the `php artisan serve` command
9. Done

#### User 1
- Email: nauvalazhar2@gmail.com
- Password: 123456

#### User 2
- Email: itskodinger@gmail.com
- Password: 123456

## Flow
**The way this application works is:**
1. Users register with their email
2. Users get an activation email
3. Activated users, log in with their email
4. They can upload their Gifs on the home page

**To whom will the Gif be displayed?**
- Basically, a Gif file uploaded by a user will only be displayed to himself and other users who follow the user who uploaded the Gif (Forgifing)
- The Gif file allows it to be displayed to all users even though other users don't follow the Gif uploader (There is an option to do this on every Gif post)

**How do users follow other users?**
- This is as simple as Twitter, users can follow other users if they want to see the Gif uploaded by the user they follow
- We changed "Followings" to "Forgifings" and "Followers" to "Forgifers"
- We changed "Follow" to "Frogif" and "Follow Back" to "Forgif Back"

**What happens when a user uploads a Gif?**
1. The user uploads a Gif file
2. The Gif file is received by the server and processed by the controller
3. The Gif file is converted to MP4 file by FFmpeg
4. The MP4 file that will be displayed by the UI (home page, profile, or other location)

**Why should it be converted to MP4?**
- Gif file cannot be paused (can only be stopped)
- MP4 video files can be paused with the HTML5 video player
- Say the duration of Gif is 5 seconds, if Gif wants to be paused at 3 seconds, then the Gif will return to second 1. With MP4 you can pause the video at 3 seconds and the video will stop at 3 seconds too

## Screenshots

![Login](https://user-images.githubusercontent.com/14899175/80867866-c0887800-8cc0-11ea-973a-6367acc18960.png)
![Home](https://user-images.githubusercontent.com/14899175/80867873-d26a1b00-8cc0-11ea-839a-74642b1c776e.png)
![Friends](https://user-images.githubusercontent.com/14899175/80867883-e746ae80-8cc0-11ea-81a0-8992b9321254.png)
