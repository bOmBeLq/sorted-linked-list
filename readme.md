# sorted-linked-list
Test task for recruitment process

## Task description
>“Implement a library providing SortedLinkedList
(linked list that keeps values sorted). It should be
able to hold string or int values, but not both. Try to
think about what you'd expect from such library as a
user in terms of usability and best practices, and apply those.”


## Library usage
There is one general SortedLinkedList which receives `comparator` as argument.  
Comparator defines list type (integer or string implemented).
```
     $list = new SortedLinkedList(new CaseInsensitiveStringComparator());
     or
     $list = new SortedLinkedList(new CaseSensitiveStringComparator());
     or
     $list = new SortedLinkedList(new IntegerComparator());
     
     $list->add($value1);
     $list->add($value2);
     $list->add($value3);
     
     $list->remove($value1);
     
     List implements \Iterator so can be either iterated like regular array
     foreach($list as $listItem) {...}
     or transformed into regular array
     $array = itertator_to_array($list); // notice we are losing LinkedList prefits this way
     List nodes (ListItem.php) is hidden from public api. 
     Depending on implementation we may want to expose it but I like to keep things easy to use.
```
### Extending list with new types
To be able to create list for custom types (eg. DatabaseUser) create comparator for given type.
```
    class DatabaseUserComparator implements Shipmonk\SortedLinkedList\Comparator\ComparatorInterface {
      [...]
    }
    $list = new SortedLinkedList(new DatabaseUserComparator());
    [...]
```

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
