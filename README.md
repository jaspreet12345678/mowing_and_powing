<p align="center"><a href="https://mowingandplowing.com" target="_blank"><img src="https://mowingandplowing.com/assets/images/logo/logo.png" width="400" alt="Laravel Logo"></a></p>

<br>

## About Mowing and Plowing

Mowing and Plowing ON-Demand service APP is currently available in select cities during our beta testing. We will continue to grow from city to city in order to ensure each customer gets the highest quality of Lawn Mowing and Snow Plowing services they deserve. 

## Development procedure

- Clone this project on your local machine
- Copy env.master or env.staging into .env and make necessary adjustments. Ex: change database credentials or stripe etc.
- Run this command in root directory of this project:
```
composer install
```
- After composer dependencies have been installed. Run this command:
```
php artisan serve
```
- Your development server will start running at: (Default)
```
http://localhost:8000
```
- Create a new branch
- Make changes in that branch
- Now commit your changes
- Switch to staging branch
- Merge your newly created branch into your local staging branch and push to remote staging branch
- Your new changes will be auto deployed via aws pipeline at:
```
https://staging.mowingandplowing.com
```
- After testing your changes on staging. Merge your local staging branch into your local main branch and push to remote main branch.
- Now your changes have been auto deployed via AWS pipeline at:
```
https://www.mowingandplowing.com
```
