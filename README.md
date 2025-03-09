# Shopping Cart Challenge

The purpose of this challenge is to develop a functioning shopping cart. It should demonstrate your ability with several languages in the typical Web development stack. Build the application in such a way that you would feel comfortable putting it in production and comfortable maintaining.

You can use any tools, framework, dependencies, or methodology you choose. If you use a framework or dependencies, be sure to separate them from the source code you actually write.

> ⚠️ Additional instructions may be provided to tweak these requirements. For example, a specific language or framework may be required or restricted, depending on the focus of the challenge.

To be clear, this shopping cart is like any other; it should provide a summary of items in the cart, as well as their quantities, subtotal, grand total, including GST and QST. It is a step before actually checking out, when payment and address must be registered. There is no need to build a product catalog and mechanism for adding items to a cart. Assume there are products in a cart already.

### Functionality

- The cart's content is stored in a database
- Enable the user to adjust the quantities of the items in the cart
- State is maintained, per session

### Minimum Technology Stack

- PHP or Python
- HTML
- JavaScript
- CSS

### Provide the following

- Source code
  - Hosted on GitHub

- Installation instructions
  - Example: utilitizing dependency management configuration via Composer or PiP.
- Tools used for development
- Online demo

## Setup Instructions

There is a live demo available at https://carttest.johnathonwood.com

## Setup Instructions

* open a terminal, cd to base dir of where you want it installed:
* `git clone git@gitlab.com:watchwood/carttest.git`
* Create Homestead.yaml file for project in root dir, based on included example. Map the information in that file to the conditions of your local setup
* create .env file for project in root dir, based on included example.
* `composer install`
* `vagrant up`
* `vagrant ssh` (to access VM internally, password is `secret`)
* `cd code`
* `php artisan key:generate`
* `php artisan migrate --seed`
* `php artisan optimize:clear`

## Relevant Code Files
 
* resources/views/home.blade.php
* public/main.css
* app/Http/Controllers/Controller.php
* app/Http/Controllers/ApiController.php
* app/Models/CartItem.php
* app/Models/Item.php

Laravel's default bootstrap code was largely left in place.
