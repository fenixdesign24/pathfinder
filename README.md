Trip sorter test
===

Running
---

Simply execute `php run_tests.php`.

It'll run all tests in PathfinderTester class.
Currently there are two test:

 - `testSort` checks that sorting method works in proper way
 - `testGeneral` checks sorting and generation human-readable output
 
Content
---

There are four classes here:

 - `BoardingCard` represents a model of boarding card. It contents some required and some optional properties.
 - `Path` represents union of all boarding cards. It acts like array and has methods for generating human-readable
 representation of full trip path.
 - `Pathfinder` is helper class that sorts boarding cards and creates `Path` instance.
 - `PathfinderTester` is used to run tests. The tests are all methods of the class those are started with `test`.
 
 **Note:** I omitted descriptions for most methods because their names are self-explaining.