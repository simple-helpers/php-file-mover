<?php
/**
 * Moves files into directories with suitable names.
 * Able to respect date and time rules.
 *
 * PHP version 5.4
 *
 * @category Class
 * @package  SimpleHelpers
 * @author   barantaran <yourchev@gmail.com>
 * @license  http://www.gnu.org/licenses/lgpl-3.0.en.html LGPL3
 * @link     http://github.com/simple-helpers/
 */

namespace SimpleHelpersPHP;

/**
 * Moves files into directories with suitable names.
 * Able to respect date and time rules.
 *
 * @category Class
 * @package  SimpleHelpers
 * @author   barantaran <yourchev@gmail.com>
 * @license  http://www.gnu.org/licenses/lgpl-3.0.en.html LGPL3
 * @link     http://github.com/simple-helpers/
 */

class FileMover
{
    /**
     * Directory containig subject files
     *
     * @var sourceDir
     */
    private $_sourceDir;

    /**
     * Array with rules of file moving
     *
     * @var suitablePath
     */
    private $_suitablePaths;

    /**
     * Available dirs
     *
     * @var dirs
     */
    private $_dirs;

    /**
     * Target files names
     *
     * @var files
     */
    private $_files;

    /**
    * Construct FileMover providing it with initial data
    *
    *  @param string $sourceDir     source directory name
    *  @param array  $suitablePaths file moving rules
    *
    *  @return void
    */
    function __construct( $sourceDir, $suitablePaths  )
    {
        $this->_sourceDir = $sourceDir;
        $this->_suitablePaths = $suitablePaths;
        if (!$this->_cacheDir()) {
            return false;
        }
    }

    /**
     * Exam source directory
     *
     * @return boolean
     */
    private function _cacheDir()
    {
        $directory = new \DirectoryIterator($this->_sourceDir);
        foreach ( $directory as $fileInfo ) {
            if (!$fileInfo->isDot()) {
                if ($fileInfo->isDir()) {
                    $this->_dirs[]["name"] = $fileInfo->getFilename();
                } else {
                    $this->_files[]["name"] = $fileInfo->getFilename();
                    $lastKey = count($this->_files)-1;
                    $pathName = $fileInfo->getPathname();
                    $this->_files[$lastKey]["path-name"] = $pathName;
                    $this->_files[$lastKey]["base-name"] = pathinfo($pathName,PATHINFO_FILENAME);
                    $this->_files[$lastKey]["m-name"] = $fileInfo->getMTime();
                }
            }
        }
        //die(print_r($this->_files));
        return true;
    }

    /**
     * Move file from source to destination
     *
     * @param string $source      source filename
     * @param string $destination file name
     *
     * @return boolean
     * */
    private function _move( $source, $destination )
    {
        if (file_exists($source)) {
            if (copy($source, $destination)) {
                unlink($source);
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Generate new filepath according to the rules
     *
     * @param string $filename source filename
     *
     * @return string destination path
     * */
    private function _generatePath( $filename )
    {
        $pathGenerated = "";
        return $pathGenerated;
    }

    /**
     * Return files discovered
     *
     * @return array
     * */
    public function getFiles()
    {
        return $this->_files;
    }

    /**
     * Return dirs discovered
     *
     * @return array
     * */
    public function getDirs()
    {
        return $this->_dirs;
    }

    /**
     * Move files into specified directories
     *
     * @return boolean
     * */
    public function moveIfMatches()
    {
        foreach ($this->_files as $fileData) {
            foreach ($this->_dirs as $dirData) {
                if (stristr($fileData["base-name"], $dirData["name"])) {
                    $this->_move($fileData["path-name"], $dirData["path-name"]);
                }
            }
        }
        return true;
    }
}
?>
