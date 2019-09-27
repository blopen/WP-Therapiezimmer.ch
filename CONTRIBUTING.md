# Current Base Version 1.6.3

# Contributing Guidelines

We do not give a shit about WordPress coding standards as we want to provide a wider understanding on programming to our apprentices/coworkers in terms on how to write clean code and reduce bad habits.

## Contributing

We use git and git-flow for version controll. If you start to working on a project, take the following workflow as your base:

* Think on how to achieve the solution of your problem
* Think again!
* If you're unsure, bring your solution to the table
* Explain your solution to a co-worker(s) and ask for inputs on how to do certain things
* Clarify open questions
* Think again!
* Check if the current working directory is clean (git status)
* Check if git flow is initialized
* Initialize git flow
* Start a feature branch (git flow feature start your_name-your_job i.e. marc-navigation)
* Think again!
* Subdevide your workflow for each task on the project
  * Make small steps (i.e. Implemented desktop Navigation -> Styled desktop navigation -> Fixed desktop navigation -> Implemented mobile navigation with seperate language selector ...)
* Start to code
* Write a lot of small commits while working
  * Commit every sub-step from your workflow (see two steps above)
* Finish your job!
  * Cross-Browser testing!
  * Check mobile devices!
  * Delete unsused/out-commented code!
* Push your feature branch to the GitHub repository
* Take a closer look on your code before open a pull request
* Change bad stuff
  * Check for unsused/out-commented again
  * Check yout class/method/property naming again (to be sure check Naming Convetion below)
* Test again
* Open a pull request on develop branch
* Inform either Marc or Alex to review your code
  * Implement issues after the code review is done
  * Inform the Person to check again
* If OK -> Merge branch into develop and DELETE feature branch
* Finish local feature branch (git flow feature finish)
* Pull origin develop

### Release management

* Ensure your local master and develop branches are up to date with the remote branches
* Check the last version number
* Think about what you've done. Bugfix, Feature or is it a complete new version
* git flow release start <version>
* Adjust version in README.md, CANGELOG.md, composer.json, package.json, style.css (older projects bower.json)
* Commit with "Version Bump"
* git flow release finish <version>
* git push --all && git push --tags

## Naming Convention

* Classname: PascalCase -> MyClassName
* Methodname: camelCase -> myMethod()
* Property: camelCase -> $myProperty
* Static property: PascalCase -> $MyStaticProperty
* Constant: ALL_CAPS -> MY_CONSTANT
* Procedural Function: lower_case -> Try not to use procedural functions at all!

## Coding standards

*<-- READ THIS -->*

See https://github.com/jupeter/clean-code-php for a general understanding on how clean code should appear.

*<-- READ THIS -->*

### General

* 4 spaces must be used for indents -> never use tabs!
* 120 characters are the maximum line length -> refactor your code if a line is getting longer
* Properties- and variablenames are selfexplaning (do not use $array, $result or $string for example) 
* One function does one thing -> keep in mind!
* A function name must describe what the function does

### PHP

The following examples are describing the basics in short

* Defining classes
```php
// Normal Class definition (Opening curly brackets goes on next line)
class MyClass
{
    // ...
}

// Class which inherits from a parent class or an abstract class
class MyClass extends MyParentClass
{
    // ...
}

// Class which implements an interace
class MyClass implements IMyInterface
{
    // ...
}

// Class WHich inherits from a parent class and impleents an interface
class MyClass extends MyParentClass implements IMyInterface
{
    // ...
}

// Interface (Getting prefixed with an upercase i (I))
interface IRenderable
{
    // ...
}

// Abstract class (Getting prefixed with an upercase a (A))
abstract class AMyAbstractClass
{
    // ...
}
```
* Defining Methods
```php
 // Opening curly brackets goes on next line
 // Code after the closing curly brackets, needs a linebreak inbetween
public function myFunction()
{
    // ...
}

public function mySecondFunction()
{
    // ...
}

//  Methods must be defined with abstract/final first, followed with public/protected, and finally static
abstract public static function myFunction();
abstract public function myFunction();

// Use meaningfull methodnames
// Bad!
public function getImage()
{
    return $this->imageSrc;
}

// Good!
public function getImageSrc()
{
    return $this->imageSrc;
}
```
* Defining properties
```php
class MyClass()
{
    //Only one Property per line is allowed

    // Define constants first
    const MY_CONSTANT = true;

    // Static properties next
    public static $MyStatic;

    // Privates
    private $myPrivateProperty;

    // Protected
    protected $myProtectedProperty;

    // Public
    public $myPublicProperty;
}
```
* If statements have one space before opening bracket and one after the closing one but not inside
* Same for loops (while, foreach, for)
```php
if (true) {
    // ...
}

if (true) {
    // ...
} else {
    // ...
}

if (false) {
    // ...

    // Use elseif instead of else if
} elseif (true) {
    // ...
} else {
    // ...
}
```

### Templates containing HTML

* Only "<?php" is allowed as an opening php-tag -> never use shorttags!
* You must not use curly brackets inside a html containing file
```php
<div class="wrapper">
    <?php foreach($examples as $example) : ?>
        <?php if($example->isVisible()) : ?>
            <p class="information">This Allows us to have a better overview over the template</p>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
```

### SCSS

* Only stylings on css classes are allowed
* Maximum nesting of selectors = 3 nestings
* Never use !important (Exceptions are poorly implemented libraries and frameworks)
* Import files are prefixed with _ (underscore) and doesn't contain any css rules

### JavaScript

* Prefix variables containing jQuery objects with a $
* JavaScript selects elements over data-attributes. CSS classes are not used as jQuery selectors (Separation of concerns)
* If you can do a job without JavaScript -> do it without!
```js
var $jQueryObject = jQuery('[data-whatever]');
var iKeepOtherValues = 2;
```

### Comments

* Dont use inline comments at all -> if you write clean code there is no need for it. If you need inline comments they are put to their own line.
* Properties deserve their own documentation comment
* Methods and classes must have their (API capable) documentation with the following points:
    * Description -> What is the purpose of the method or class
    * Parameter (@param) -> type 
    * Return value (@return) -> type
    * Author (@author) -> Prename Surname <your-email@address.ch>
    * Since (@since) -> Version of the Theme
    * Version (@version) -> Version of the method / class

```php

// example for a class
/**
 * Here goes a summary of the class
 * 
 * Here goes an indepth description of the class and 
 * this may take several lines of comments
 * 
 * @abstract
 * 
 * @author Marc Mentha <marc@cubetech.ch>
 * @author Christoph S. Ackermann <acki@cubetech.ch>
 * @since 1.0.0
 * @version 1.0.0
 */
```

```php

// example for a method 
/**
 * Returns a "Theme Options" field -> Summary
 * 
 * If the vlue already is set in transient "ct_option_cache" -> Indepth
 * this value will be returned
 * If the value is not found in the transient,
 * this function will call get_option and safe the value to the transient afterwards
 *
 * @param string $key
 * @return mixed
 * 
 * @author Marc Mentha <marc@cubetech.ch>
 * @since 1.0.0
 * @version 1.0.0
 */
```

```php

// example for a property
/**
 * The post's creation date (WP_Post->post_date)
 * as UNIX-Timestamp
 *
 * @var int
 */
private $date;
```
