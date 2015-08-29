<?php
// @codingStandardsIgnoreFile
class FileMoverTest extends PHPUnit_Framework_TestCase
{
    protected static $srcDir;
    protected static $dstDirs;
    protected static $files;


    public static function setUpBeforeClass()
    {
        self::$srcDir = "/tmp/filemovertest";
        self::$dstDirs = array(
            "destTest_1_dir",
            "destTest_2_dir"
        );
        self::$files = array(
            "destTest_1.dum",
            "destTest_2.dum"
        );

        @mkdir(self::$srcDir);
        foreach( self::$dstDirs as $oneDir ){
            @mkdir(self::$srcDir. DIRECTORY_SEPARATOR . $oneDir);
        }
        foreach( self::$files as $oneFile ){
            fopen(self::$srcDir . DIRECTORY_SEPARATOR . $oneFile, "w");
        }
    }

    public function test_catalogueIt()
    {
       $mover = new \SimpleHelpersPHP\FileMover( self::$srcDir, array() );
    }

    public static function tearDownAfterClass()
    {
        foreach( self::$files as $oneFile ){
            unlink(self::$srcDir . DIRECTORY_SEPARATOR . $oneFile);
        }
        foreach( self::$dstDirs as $oneDir ){
            rmdir(self::$srcDir. DIRECTORY_SEPARATOR . $oneDir);
        }
        rmdir(self::$srcDir);

    }

}
?>
