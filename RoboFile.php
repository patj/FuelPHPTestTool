<?php

class RoboFile extends \Robo\Tasks
{

    private $mode = null;
    private $testFile = null;

    public function watch(){

        $this->taskWatch()
            ->monitor('./codeception/tests/acceptance/',
                      function( $e ){
                          print "codeception file changed";
                          $this->testFile = $e->getResource();
                          $this->mode = 'codeception';
                          $this->__test();
                      }
            )->monitor('./fuel/app/tests/',
                       function( $e ){
                           print "phpunit test file changed";
                           if( preg_match( '/\.php$/', $e->getResource() ) ){
                               $this->testFile = $e->getResource();
                               $this->mode = 'phpunit';
                           }
                           $this->__test();
                       }
            )->monitor('./fuel/app/views',
                       function( $e ){
                           print "src file changed";
                           $this->__test();
                       }
            )->monitor('./fuel/app/classes',
                       function( $e ){
                           print "src file changed";
                           $this->__test();
                       }
            )->run();


    }

    public function phpunit(){
        $this->taskPHPUnit()
            ->configFile('./fuel/app/phpunit.xml')
            ->args( './fuel/app/tests' )
            ->run();
    }

    public function codeception(){

        $this->taskCodecept()
            ->suite('acceptance')
            ->configFile('./codeception/codeception.yml')
            ->run();
    }

    private function __test(){

        if( $this->testFile == null ){
            print "TestFile is not set";
            return;
        }

        if( $this->mode == 'codeception' ){
            $this->taskCodecept()
                ->suite('acceptance')
                ->option('steps')
                ->configFile('./codeception/codeception.yml')
                ->args( $this->testFile )
                ->run();
        }

        if( $this->mode == 'phpunit' ){
            $this->taskPHPUnit()
                ->configFile('./fuel/app/phpunit.xml')
                ->args( $this->testFile )
                ->run();

        }

    }

}
