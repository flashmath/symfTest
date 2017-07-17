<?php
/**
 * Created by PhpStorm.
 * User: Fabrice
 * Date: 07/07/2017
 * Time: 22:42
 */

namespace AppBundle\EventListener;


use AppBundle\Service\FileUploader;
use AppBundle\Entity\Product;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class BrochureUploadListener
{
    private $uploader;

    /**
     * BrochureUploadListener constructor.
     * @param $uploader
     */
    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args){
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args){
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    private function uploadFile($entity){
        if (!$entity instanceof Product){
            return;
        }

        $file = $entity->getBrochure();

        if (!$file instanceof UploadedFile){
            return;
        }

        $fileName = $this->uploader->upload($file);
        $entity->setBrochure($fileName);
    }

}