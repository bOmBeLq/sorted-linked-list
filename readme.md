# sorted-linked-list
Test task for recruitment process

## Task description
>“Implement a library providing SortedLinkedList
(linked list that keeps values sorted). It should be
able to hold string or int values, but not both. Try to
think about what you'd expect from such library as a
user in terms of usability and best practices, and apply those.”

## Development env 
### Requirements:
docker installed
### Setup
1. Run bin/build-dev.sh
2. Run composer install  
`bin/run-dev.sh composer install`
3. Use bin/run-dev.sh to execute commands in php contianer eg.  
`bin/run-dev.sh composer require some-pabckage`  
`bin/run-dev.sh php --version`
`etc.`
### Running tests
`bin/test.sh`
### Code style (php-cs-fixer)
`bin/php-cs-fixer.sh`