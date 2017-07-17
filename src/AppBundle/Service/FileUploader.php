<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Created by PhpStorm.
 * User: Fabrice
 * Date: 07/07/2017
 * Time: 22:46
 */
class FileUploader
{
    private $targetDir;

    /**
     * FileUploader constructor.
     * @param $targetDir
     */
    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    /**
     * @return mixed
     */
    public function getTargetDir()
    {
        return $this->targetDir;
    }

    public function upload(UploadedFile $file){
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();

        $file->move(
            $this->getTargetDir(), $fileName
        );

        return $fileName;

    }

}