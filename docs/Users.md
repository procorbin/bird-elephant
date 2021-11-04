# Users

Documentation in progress - here are some quick examples in the meantime:

```php
use Coderjerk\BirdElephant\BirdElephant;

$twitter = new BirdElephant;

$user = $twitter->user($user_name);

// get a user's followers
$user->followers();

// get accounts that a user follows
$user->following();

// get a user's likes
$user->likes();

// do the same thing but with some params - check the Twitter reference above for all available params
$user->following([
    'max_results' => 20,
    'user.fields' => 'profile_image_url'
]);

// follow an account on behalf of a named user, needs to be the currently authenticated user.
$user->follow('coderjerk');

//..and unfollow an account
$user->unfollow('barrymanilow');

// see what accounts you've blocked (on behalf of the currently authenticated user only)
$user->blocks();

// block a user
$user->block('GilbertOSull_');

// unblock a user
$user->unblock('claydermanmusic');

// mute a user by handle - the first handle must be the authorised user
$user->mute('kennyg');

// unmute a user
$user->unmute('kennyg');

// follow a list on behalf of the named user
$user->lists()->follow($list_id);

// unfollow a list
$user->lists()->unfollow($list_id);
```

Proper method documentation to follow shortly.

### Methods

#### `followers()`
Gets a Twitter user's followers
Auth: OAuth 2.0 Bearer token

| Argument | Type  | Description                                    |          |
|----------|-------|------------------------------------------------|----------|
| $params  | Array | see Twitter docs for avilable query parameters | optional |


#### `following()`
Gets a Twitter user's followed accounts
Auth: OAuth 2.0 Bearer token
| Argument | Type  | Description                                    |          |
|----------|-------|------------------------------------------------|----------|
| $params  | Array | see Twitter docs for avilable query parameters | optional |

#### `follow()`
Follows a given user
Auth: OAuth 1.0a User context

| Argument | Type  | Description                                    |          |
|----------|-------|------------------------------------------------|----------|
| $target_username | Array | The target twitter username | required |

#### `unfollow()`
Unfollows a given user
Auth: OAuth 1.0a User context

| Argument         | Type  | Description                 |          |
|------------------|-------|-----------------------------|----------|
| $target_username | Array | The target twitter username | required |

#### `blocks()`
Gets the blocked accounts of a Twitter user.
Auth: OAuth 1.0a User context

#### `block()`
Blocks a given user
Auth: OAuth 1.0a User context

| Argument         | Type  | Description                 |          |
|------------------|-------|-----------------------------|----------|
| $target_username | Array | The target twitter username | required |

#### `unblock()`
Unblocks a given user
Auth: OAuth 1.0a User context

| Argument         | Type  | Description                 |          |
|------------------|-------|-----------------------------|----------|
| $target_username | Array | The target twitter username | required |

#### `mutes()`
Gets the muted accounts of a Twitter user.
Auth: OAuth 1.0a User context

#### `mute()`
Mutes a given user
Auth: OAuth 1.0a User context

| Argument         | Type  | Description                 |          |
|------------------|-------|-----------------------------|----------|
| $target_username | Array | The target twitter username | required |

#### `unmute()`
Unmutes a given user
Auth: OAuth 1.0a User context

| Argument         | Type  | Description                 |          |
|------------------|-------|-----------------------------|----------|
| $target_username | Array | The target twitter username | required |

#### `likes()`
Gets the named user's last 100 likes
Auth: OAuth 1.0a User context

#### `like()`
Likes a tweet on behalf of the authenticated user
Auth: OAuth 1.0a User context


#### `unlike()`
Unlikes a tweet on behalf of the authenticated user
Auth: OAuth 1.0a User context

#### `retweet()`
Retweets a tweet on behalf of the authenticated user
Auth: OAuth 1.0a User context

#### `unretweet()`
Unretweets a tweet on behalf of the authenticated user
Auth: OAuth 1.0a User context

#### `spaces()`
Gets a user's spaces
Auth: OAuth 2.0 Bearer token

### User Lists
User related list actions
Auth: OAuth 1.0a User context

#### `lists()->follow($target_list_id)`
#### `lists()->unfollow($target_list_id)`
#### `lists()->pin($target_list_id)`
#### `lists()->unpin($target_list_id)`