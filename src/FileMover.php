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
     * Target files names
     *
     * @var files
     */
    private $_targetFiles;

    /**
    * Construct FileMover providing it with initial data
    *
    *  @param array  $suitablePaths file moving rules
    *  @param string $sourceDir     source directory name
    *
    *  @return void
    */
    public function FileMover( $suitablePaths, $sourceDir )
    {
        $this->_suitablePaths = $suitablePaths;
        $this->_sourceDir = $sourceDir;
    }

    /**
     * Exam source directory
     *
     * @return boolean
     */
    private function _catalogueIt()
    {
        foreach ( new DirectoryIterator($this->sourceDir) as $fileInfo ) {
            if ($fileInfo->isDot() || $fileInfo->isDir()) {
                $this->_targetFiles[] = $fileInfo->getFilename();
            }
        }

        return true;
    }

    /**
     * Generate new filepath according to the rules
     *
     * @param string $filename source filename
     * @param array  $rules    applied rules
     *
     * @return string destination path
     * */
    private function _generatePath( $filename, $rules )
    {
        $pathGenerated = "";
        return $pathGenerated;
    }

    /**
     * Move files into specified directories
     *
     * @return boolean
     * */
    public function moveIt()
    {
        return true;
    }

}
?>
