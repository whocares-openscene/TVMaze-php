# README

Simple PHP interface for TVMaze API http://www.tvmaze.com/api

### Usage
```
include_once('TVMaze.class.php');
```

#### Available functions
```php
$tvmaze = new TVMaze();
$tvmaze->listings($country, $date); // TV Schedule for Country (ISO 3166-1 country code) and Date (ISO 8601 formatted date) which are optional, defaults to US and the current day
$tvmaze->fullschedule(); // Full TV schedule
$tvmaze->search($name, $type, $embed); // Searches the API, Valid types are tvrage, thetvdb, person and shows, If no type defines it defaults to shows, $embed is optional and can be either a string for a single item or array for multiple embeded items
$tvmaze->single($name, $embed); // Uses the single show search, $embed is optional and  can be either a string for a single item or array for multiple embeded items
$tvmaze->show($id, $embed); // Returns information about a specific show ID, $embed is optional and  can be either a string for a single item or array for multiple embeded items
$tvmaze->episode($id, $episode); // Returns episode information, $episode is optional and will return all episodes, $episode can be either in S01E01 format or by a ISO 8601 formatted date
$tvmaze->cast($id); // Returns the cast information for the show ID
$tvmaze->akas($id); // Returns the aliases information for the show ID
$tvmaze->person($id, $embed); // Returns information about a specific person ID, $embed is optional and  can be either a string for a single item or array for multiple embeded items
$tvmaze->credits($id, $type, $embed); // Returns credits for a specific person ID, $type can be either 'cast' or 'crew', $embed is optional and  can be either a string for a single item or array for multiple embeded items
```

##### Notice
For all functions returns an associative array
