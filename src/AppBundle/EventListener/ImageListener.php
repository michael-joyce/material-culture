<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\EventListener;

use AppBundle\Entity\Clipping;
use AppBundle\Entity\ImageTrait;
use AppBundle\Services\FileUploader;
use AppBundle\Services\Thumbnailer;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Description of ClippingListener
 *
 * @author Michael Joyce <ubermichael@gmail.com>
 */
class ImageListener {

    /**
     * @var FileUploader
     */
    private $uploader;
    
    /**
     * @var Thumbnailer
     */
    private $thumbnailer;

    /**
     * @var int
     */
    private $thumbWidth;

    /**
     * @var int
     */
    private $thumbHeight;

    public function __construct(FileUploader $uploader, Thumbnailer $thumbnailer) {
        $this->uploader = $uploader;
        $this->thumbnailer = $thumbnailer;
    }
    
    public function setThumbWidth($width) {
        $this->thumbWidth = $width;
    }
    
    public function setThumbHeight($height) {
        $this->thumbHeight = $height;
    }
    
    public function prePersist(LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        if($entity instanceof ImageTrait) {
            $this->uploadFile($entity);
        }
    }
    
    public function preUpdate(LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        if($entity instanceof ImageTrait) {
            $this->uploadFile($entity);
        }
    }
    
    public function postLoad(LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        if($entity instanceof ImageTrait) {
            $filename = $entity->getImageFilePath();
            if(file_exists($this->uploader->getImageDir() . '/' . $filename)) {
                $file = new File($this->uploader->getImageDir() . '/' . $filename);
                $entity->setImageFile($file);
            }
        }
    }
    
    private function uploadFile(ImageTrait $image) {
        $file = $image->getImageFile();
        if( ! $file instanceof UploadedFile) {
            return;
        }
        $filename = $this->uploader->upload($file);        
        $image->setImageFilePath($filename);
        $image->setOriginalName($file->getClientOriginalName());
        $image->setImageSize($file->getClientSize());
        $dimensions = getimagesize($this->uploader->getImageDir() . '/' . $filename);
        $image->setImageWidth($dimensions[0]);
        $image->setImageHeight($dimensions[1]);
        
        $clippingFile = new File($this->uploader->getImageDir() . '/' . $filename);        
        $image->setImageFile($clippingFile);
        $image->setThumbnailPath($this->thumbnailer->thumbnail($image));
    }
}