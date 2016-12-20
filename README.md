## Aylon's Task for Finance Genius

I decided to split the program into 3 classes.
Program, Database and Card.

Program will receive the initial input after running run.php, it will take the input and then according to the action in the first input command will use the method of the same name in the Database Class

Database will keep a array of the cards(Accounts) which are objects of Card. It has methods for the actions that are allowed, and if credit or charge will call the method of the same name in Card to modify the balance

Card is the class that holds all the information like Name, card number, balance, limit and changes.  It tracks changes to the card, so any balance update is stored in the changes array.  It has 3 methods, charge, credit and luhnCheck the last of which checks for the validity of the credit card.

###Why I chose PHP
I could have easily done this challenge in Nodejs or Python as the logic behind this program is pretty simple to replicate in any language.  I know PHP most of all, so it made sense to do it in it. I don't have a specific reason to use any, all 3 have very easy file system methods.


##How to run this program
First install the components and populate the autoloader.

`composer install`

CLI:
It can take the file name by command inputs or STDIN
Examples:

```$xslt
php run.php input.txt
or
php run.php < input.txt
```

The unit tests are using PHPUnit

`phpunit`

This will run the tests in the tests directory
