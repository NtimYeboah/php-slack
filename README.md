Integrate Slack into your PHP applications
==========================================

![Build Status](https://github.com/NtimYeboah/php-slack/actions/workflows/test.yml/badge.svg)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)


This package makes it easier to integrate Slack into your PHP application. It provides intuitive and simple API to send simple messages and complex messages using the BlockKit framework.

## Requirements

This package requires at least [PHP](https://php.net) 8.2.


## Installation

```bash
composer require ntimyeboah/php-slack
```


## Basic Usage

### Sending messages
You have the option to send messages by configuring the Slack token and channel methods on the SlackMessage object using the `token()` and `channel()` methods respectively.
```php
use NtimYeboah\PhpSlack\SlackMessage;

(new SlackMessage)
    ->token('xoxb-123abc')
    ->channel('general')
    ->text('Hello')
    ->send();
```

You can also configure the Slack token and channel using the Credentials object.
```php
use NtimYeboah\PhpSlack\Credentials

$credentials = Credentials::make('general', 'xoxb-123abc');

$slackMessage = new SlackMessage($credentials);

$slackMessage->text('Hello')
$slackMessage->send();
```

## Advanced Usage
This package make it easy to send messages using the BlockKit framework to customize and order the appearance of your messages.

### Sending messages using the Section block
Use the `section($closure)` method to send a Section block.
```php
$credentials = Credentials::make('general', 'xoxb-123abc');

(new SlackMessage($credentials))
    ->section(function (Section $section) {
        $section->field('This is a field')->markdown();
        $section->field('This is another field');
    })
    ->send();
```
The above generates these blocks.
```
[
    {
        "type": "section",
        "fields": [
            {
                "type": "mrkdwn",
                "text": "This is a field"
            },
            {
                "type": "plain_text",
                "text": "This is another field"
            }
        ]
    }
]
```

### Sending messages using the Context block
Use the `context($closure)` method to send a Context block.
```php
$credentials = Credentials::make('general', 'xoxb-123abc');

(new SlackMessage($credentials))
    ->context(function (Context $block) {
        $block->text("*This* is :smile markdown")->markdown();
        $block->image('http://path/to/image.jpg')->altText('cute cat');
        $block->text('This is a plain text');
    })
    ->send()
```
The above generates these blocks.
```
[
    {
        "type": "context",
        "elements": [
            {
                "type": "mrkdwn",
                "text": "*This* is :smile markdown"
            },
            {
                "type": "image",
                "image_url": "http:\/\/path\/to\/image.jpg",
                "alt_text": "cute cat"
            },
            {
                "type": "plain_text",
                "text": "This is a plain text"
            }
        ]
    }
]
```

### Sending messages using the Header block
Use the `header($closure)` method to send a Header block.
```php
$credentials = Credentials::make('general', 'xoxb-123abc');

(new SlackMessage($credentials))
    ->header(function (Header $block) {
        $block->text('This is a header text');
    })
    ->send();
```
The code above generates these blocks.
```
[
    {
        "type": "header",
        "text": {
            "type": "plain_text",
            "text": "This is a header text"
        }
    }
]
```

### Sending messages using the RichText block
Use the `richText($closure)` method to send a Rich Text block.
```php
$credentials = Credentials::make('general', 'xoxb-123abc');

(new SlackMessage($credentials))
    ->richText(function (RichText $block) {
        $block->text('This is a text');
        $block->text('This is a bold text')->bold();
        $block->text('This is an italic text')->italic();
        $block->text('This is a strikethrough text')->strike();
        $block->emoji('basketball');
    })
    ->send();
```
The above generates these blocks.
```
[
    {
        "type": "rich_text",
        "elements": [
            {
                "type": "rich_text_section",
                "elements": [
                    {
                        "type": "text",
                        "text": "This is a text"
                    },
                    {
                        "type": "text",
                        "text": "This is a bold text",
                        "style": {
                            "bold": true
                        }
                    },
                    {
                        "type": "text",
                            "text": "This is an italic text",
                            "style": {
                                "italic": true
                        }
                    },
                    {
                        "type": "text",
                        "text": "This is a strikethrough text",
                        "style": {
                            "strike": true
                        }
                    },
                    {
                        "type": "emoji",
                        "name": "basketball"
                    }
                ]
            }
        ]
    }
]
```

### Sending messages using the Divider block
Use the `divider()` method to send a Divider block.
```php
$credentials = Credentials::make('general', 'xoxb-123abc');

(new SlackMessage($credentials))
    ->divider()
    ->send();
```
The above generates this block.
```
[
    {
        type": "divider"
    }
]
```

## Consider hiring me
I am currently seeking new employment opportunities and would appreciate it if you'd keep me in mind for roles such as Backend Developer.
Kindly contact me at: ntimobedyeboah@gmail.com

This is a link to my CV: [Ntim Yeboah CV](https://docs.google.com/document/d/1jXVsN1NU5AH2XhStxjuwumGIqunoyk0cPPXZr6viaNs/edit?usp=sharing)


## Changelog

Please see [CHANGELOG](https://github.com/NtimYeboah/php-slack/blob/master/CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/NtimYeboah/php-slack/blob/master/CONTRIBUTING.md) for details.


## Security

If you discover a security vulnerability within this package, please send an e-mail to Ntim Yeboah at ntimobedyeboah@gmail.com. All security vulnerabilities will be promptly addressed.


## License

Php Slack is licensed under [The MIT License (MIT)](LICENSE).
