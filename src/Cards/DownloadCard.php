<?php

namespace Cubetech\Cards;

/**
 * Class for an download card handling
 *
 * @author Steeve Jeannin <steeve@cubetech.ch>
 * @since 0.0.1
 * @version 1.0.0
 */
class DownloadCard extends BaseCard
{
    
    /**
     * Initializes class properties
     *
     * @param CubetechPost $post
     * @return void
     *
     * @author Steeve Jeannin <steeve@cubetech.ch>
     * @version 1.0.0
     * @since 1.0.0
     */
    public function __construct($postId)
    {
        parent::__construct("DownloadCard", $postId);
        $this->title = $this->extractTitle();
        $this->lead = $this->extractLead();
        $this->fileId = intval($this->extractFile());
        $this->fileName = $this->fileId ? wp_get_attachment_url($this->fileId) : "";
        $this->fileSize = self::getFileSize($this->fileId);
    }
    
    /**
     * Checks if the optional file is set
     * Defaults to false if empty
     *
     * @return string|false
     * @version 1.0.0
     * @since 1.0.0
     * @author Steeve Jeannin <steeve@cubetech.ch>
     */
    private function extractFile()
    {
        if ($this->post->isFieldValid('file')) {
            return $this->post->getField('file');
        }
        return false;
    }
    
    /**
     * creates string containing size and sizeunit of given file
     *
     * @param int : $fileId
     * @return string -> the size of the given file
     * @author Sybille Hofer <sybille.hofer@cubetech.ch>
     * @author Steeve Jeannin <steeve@cubetech.ch>
     * @version 1.0
     */
    public static function getFileSize($fileId)
    {
        $filesize_string = "";
        if (file_exists(get_attached_file($fileId))) {
            $size = filesize(get_attached_file($fileId)); // get size of given file
            $units = [
                'B',
                'KB',
                'MB',
                'GB',
                'TB',
                'PB',
                'EB',
                'ZB',
                'YB',
            ]; // prepare array of possible units
            $power = $size > 0 ? floor(log($size, 1024)) : 0; // detect correct unit for file size
            $filesize_string = number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power]; // create string out of size and unit
        }
        return $filesize_string;
    }
}
