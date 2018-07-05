<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 05/07/2018
 * Time: 14:17
 */

namespace App\Service;


use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\DependencyInjection\ContainerInterface;


class UploadService
{
    private $directory;
    public function __construct( ContainerInterface $container )
    {
        $this->directory = $container->getParameter('upload_directory');
    }

    public function upload( UploadedFile $file ) {
        $fileName = md5( uniqid()).' . '.$file->guessExtension();
        $file->move($this->directory, $fileName);
        return $fileName;
    }
}