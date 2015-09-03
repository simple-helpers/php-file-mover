<?php
// @codingStandardsIgnoreFile
class MatchesMoverTest extends PHPUnit_Framework_TestCase
{
    protected static $srcDir;
    protected static $dstDirs;
    protected static $files;
    protected static $mover;


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

        self::$mover = new \SimpleHelpersPHP\FileMover( self::$srcDir, array() );

    }

    public function test_moveMatches()
    {
        $result = self::$mover->moveMatches();

        $this->assertTrue($result);
    }

    public function test_constructor()
    {
        $this->assertEquals(count(self::$files), count(self::$mover->getFiles()));
    }

    public function test_file_1_copied_into_dst()
    {
        $this->assertFileExists( self::$srcDir . DIRECTORY_SEPARATOR . self::$dstDirs[0] . DIRECTORY_SEPARATOR . self::$files[0] );
    }

    public function test_file_2_copied_into_dst()
    {
        $this->assertFileExists( self::$srcDir . DIRECTORY_SEPARATOR . self::$dstDirs[1] . DIRECTORY_SEPARATOR . self::$files[1] );
    }

    public function test_file_1_removed_from_src()
    {
        $this->assertFileNotExists( self::$srcDir . DIRECTORY_SEPARATOR . self::$files[0] );
    }

    public function test_file_2_removed_from_src()
    {
        $this->assertFileNotExists( self::$srcDir . DIRECTORY_SEPARATOR . self::$files[1] );
    }

    public static function tearDownAfterClass()
    {
        foreach( self::$files as $key => $oneFile  ){
            unlink(self::$srcDir . DIRECTORY_SEPARATOR . self::$dstDirs[$key] . DIRECTORY_SEPARATOR . $oneFile);
        }
        foreach( self::$dstDirs as $oneDir  ){
            rmdir(self::$srcDir. DIRECTORY_SEPARATOR . $oneDir);
        }
        rmdir(self::$srcDir);
    }
}
?>
