# git-last-commit-sha-checker

## installation
```composer install```

## usage examples
```./app check php-fig/log master```

## notes
This is my first try with Symfony Console, since I work on a different framework. There are several things I would do if 
I would be able to spend more time on it:
* turn off class displaying on exceptions - to leave only messages
* inject html parser instead of creating instance in command execution code
* actually it would be good to make it possible to not rely only on html parsers - we could use also git client.
both html parsers and git clients should share the interface so we could easily choose what do we use
* caching found GitServices to not check the directory every time 

