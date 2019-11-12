## About Sakai Bot

This is a bot that abstracts the process of interacting with the sakai website through a bot.
It does this by leveraging the endpoints provided here and neatly packaging resources from these
endpoints and making it available through a bot.

## Getting Started

To get started,
1. Start by cloning the repository
```
git clone https://github.com/besemuna/sakaibot
```

2. cd into the directory and install packages
```
cd sakaibot && composer install
```

3. Setup webhook
```
php artisan botman:telegram:register
```
Enter the address of your webserver where the app is running. Eg ``` http://server.io/botman ```


## Deployment

``` Docker deployment would be uploaded soon... ```

## Security Vulnerabilities

If you discover a security vulnerability within this project, please send an e-mail to me at besemuna@gmail.com. All security vulnerabilities will be promptly addressed.

## License

This project is free software distributed under the terms of the MIT license.

