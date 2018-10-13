[![Packagist](https://img.shields.io/packagist/l/doctrine/orm.svg)]()

# LaraGab - Gab Laravel API package [![Gab](https://upload.wikimedia.org/wikipedia/commons/thumb/9/9c/Gab_text_logo.svg/30px-Gab_text_logo.svg.png )](https://v2.gab.ai/Pynex)
Gab API for Laravel 5

Before you can utilise this API you need to have an developer account (which requires a Pro account), click [**here**](https://v2.gab.ai/settings/clients) to go to your settings.

## Installation
First add `bishopj88/laragab` to `composer.json`.
```
"bishopj88/laragab": "~1.0"
```
Run `composer update` to pull down the latest version of LaraGab.
Or run
```
composer require bishopj88/laragab
```
Now open up `/config/app.php` and add the service provider to your `providers` array.
```php
'providers' => [
	BishopJ88\LaraGab\LaraGabServiceProvider::class,
]
```
Now add the alias.
```php
'aliases' => [
	'LaraGab' => BishopJ88\LaraGab\Facades\LaraGabFacade::class,
]
```
---
### LaraGab configuration

Run `php artisan vendor:publish --provider="BishopJ88\LaraGab\LaraGabServiceProvider"` and modify the config file with your own information.
```
/config/laragab.php
```
Or even better, just add the following to your .env file and you'll be on your way:
```
LARAGAB_CLIENTID=
LARAGAB_SECRET=
LARAGAB_REDIRECT_URI=
LARAGAB_SCOPE="read engage-user engage-post write-post notifications"

LARAGAB_TOKEN_TYPE=
LARAGAB_EXPIRES_IN=
LARAGAB_ACCESS_TOKEN=
LARAGAB_REFRESH_TOKEN=
```
---
## Methods

### Connection
* `generateLoginURL( $client_id, $redirect_uri, $scope, $html = 0)` - Generates a URL that can be used to authenticate.
* `get_access_token( $code )` - Retrieving the access tokens.

### Engage Posts
* `postUpvote( ['postID' => ''] )` - Upvotes given post.
* `removeUpvote( ['postID' => ''] )` - Removes the upvote for given post.
* `removeDownvote( ['postID' => ''] )` - Removes the downvote for given post.
* `postDownvote( ['postID' => ''] )` - Downvotes given post.
* `postRepost( ['postID' => ''] )` - Reposts given post.
* `removeRepost( ['postID' => ''] )` - Remove repost record for given post.
* `getPostDetails( ['postID' => ''] )` - Returns the details of given post.

### Engage Users
* `unfollowUser( ['username' => ''] )` - Unfollows given user.
* `followUser( ['username' => ''] )` - Follows given user or creates a follow request if the target user is private.

### Notifications
* `getNotifications( ['before' => 0] )` - Returns latest notifications.

### Read
* `getMe()` - Returns the information about logged-in user.
* `getUser( ['username' => ''] )` - Returns the information about a user with given username.
* `getUserFollowers( ['username' => '', 'before' => 0] )` - Returns followers of given user.
* `getUserFollowing( ['username' => '', 'before' => 0] )` - Returns the users that given user is following.
* `getFeed( ['before' => ''] )` - Returns the main feed of the authenticated user.
* `getUserFeed( ['username' => '', 'before' => 0] )` - Returns the feed of given user.
* `getPopularFeed()` - Returns the popular feed.
* `getPopularUsers()` - Returns popular users.
* `getPopularGroups()` - Returns a list of groups with more activities recently.
* `getGroupDetails( ['group_id' => ''] )` - Returns details of given group.
* `getGroupUsers( ['group_id' => '', 'before' => 0] )` - Returns a list of given group's members.
* `getGroupModerationLogs( ['group_id' => ''] )` - Returns a list of given group's moderation logs.

### Write Post
* `createPost( ['body' => 'test'] )` - Creates a post. [**Check here**](https://developers.gab.com/#949155f0-821e-3228-49ea-4b15f35422a3) for all options.
* `createMediaAttachment( ['file' => 'File URL'] )` - Creates a media attachment with given image.
---
## Authentication Example

First create a link allowing you to authorize the app with your Gab account (you could technically also redirect it directly using the ```'html => 0'``` parameter):
```php
Route::get('/gab/login', function()
{
    $gab = new \LaraGabai;
    echo $gab::generateLoginURL(
        Config::get('laragabai.gab_clientID'),
        Config::get('laragabai.gab_redirect_uri'),
        Config::get('laragabai.gab_scope'),
        1);
});
```
Secondly, create a route for the callback. This should be the same as your redirect_URI in your config:
```php
Route::get('/gab/callback', function()
{
    $code = Request::query('code');
    
    $gab = new \LaraGabai;
    echo $gab::get_access_token( $code );
});
```
When this step is succesful, you'll receive your tokens (in JSON format). You could write something that saves it to a file, database or cache. But I decided not to include this so you have maximum flexibility what you want to do next.

After this, when you've saved your tokens and hooked them up to your .env or config file, now the fun can begin:
```php
Route::get('/gab/fun', function()
{
    $gab = new \LaraGab;
    // Shows Andrew's account details
    echo $gab::getUser(['username' => 'a']);
    // Returns a media attachment (only images are allow... GIFs up to 4MB)
    echo $gab::createMediaAttachment(['file' => public_path() . '/photo_2018-07-30_21-03-33.jpg']);
    // Returns your own account details
    echo $gab::getMe();
});
```













## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.