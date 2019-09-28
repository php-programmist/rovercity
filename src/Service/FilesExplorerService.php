<?php

namespace App\Service;

class FilesExplorerService
{
    public function getFilesFromFolder($folder, $extensions = [], $full_path = true)
    {
        $folder = $folder === '/' ? '' : ('/' . trim($folder, '/'));
        $source = $_SERVER['DOCUMENT_ROOT'] . $folder;
        $files  = [];
        if ( ! file_exists($source)) {
            return [];
        }
        $source = rtrim($source, '/');
        
        if (is_dir($source)) {
            if ($dh = opendir($source)) {
                while (($file = readdir($dh)) !== false) {
                    if (@filetype($source . DIRECTORY_SEPARATOR . $file) == 'file') {
                        $extension = pathinfo($source . DIRECTORY_SEPARATOR . $file, PATHINFO_EXTENSION);
                        
                        if (empty($extensions) || in_array($extension, $extensions)) {
                            $files[] = ($full_path ? $folder . '/' : '') . $file;
                        }
                        
                    }
                }
                closedir($dh);
            }
        }
        natsort($files);
        
        return $files;
    }
    
    public function getImagesFromFolder($folder,$full_path=true)
    {
        $extensions = ['jpg', 'jpeg', 'png', 'webp'];
        
        return $this->getFilesFromFolder($folder, $extensions,$full_path);
    }
}