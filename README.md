## Installation

[PHP](https://php.net) 8.1+ and [Composer](https://getcomposer.org) are required.


## Configuration

To get started, you'll need to follow below steps:

```bash
$ composer install
$ npm install
```
## Usage

Download RSS feed from URL:

```php
  $rss = Feeder::loadRss($url);
```

The returned properties are SimpleXMLElement objects. Extracting
the information from the channel is easy:


```php
  echo 'Title: ', $rss->title;
  echo 'Description: ', $rss->description;
  echo 'Link: ', $rss->link;

  foreach ($rss->item as $item) {
    echo 'Title: ', $item->title;
    echo 'Link: ', $item->link;
    echo 'Timestamp: ', $item->timestamp;
    echo 'Description ', $item->description;
    echo 'HTML encoded content: ', $item->{'content:encoded'};
  }
```

Download Atom feed from URL:

```php
  $atom = Feeder::loadAtom($url);
```

## Contributing

Please feel free to fork this package and contribute by submitting a pull request to enhance the functionalities.

## How can I thank you?

Why not star the github repo? I'd love the attention! Why not share the link for this repository on Twitter or HackerNews? Spread the word!

Don't forget to [follow me on twitter](https://twitter.com/unicodeveloper)!

Thanks!
Prosper Otemuyiwa.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Security

If you discover any security related issues, please email [prosperotemuyiwa@gmail.com](prosperotemuyiwa@gmail.com) instead of using the issue tracker.
