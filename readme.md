1.  download Laragon (the best Apache Server in town)
2.  Clone this repository into laragon/www
3.  create db name debt (laragon should did this for you)
4.  Cd to the project folder
5.  RUn this command `composer update` and then run `npm install`
6.  Run this command `php artisan key:generate`
7.  Edit the `.env` file, change the db configuration according to your db configurations
8.  Run this command `php artisan migrate` to generate the db structure (your db name should be debt)
9.  Tip: Download and install phpmyadmin into your laragon (google it)
10. Restart all laragon services
