<?php
namespace App\Attachment;

use App\Model\Post;
use Intervention\Image\ImageManager;

class PostAttachment {
    
    public static function upload(Post $post) {
        $image= $post->getImage();
        if(empty($image) || $post->shouldUpload()===false ){
            return;
        }
        $directory =  UPLOAD_PATH . DIRECTORY_SEPARATOR. 'posts';
        if(file_exists($directory)===false){
            mkdir($directory, 0777, true);
        }
        if(!empty($post->getOldImage())){
            
            $formats= ['small','cardArticle','cardChannel'];
            foreach($formats as $format){
                $oldFile = $directory . DIRECTORY_SEPARATOR .$post->getOldImage().'_'.$format.'.jpg';
                if (file_exists($oldFile)){
                     unlink($oldFile);
                }
            }
            
           
        }
        $filename =uniqid("",true);
        $manager = new ImageManager(array('driver' => 'gd'));
        $manager
            ->make($image)
            ->fit(350,200)
            ->save($directory.DIRECTORY_SEPARATOR.$filename.'_small.jpg');
        $manager
            ->make($image)
            ->resize(400, 300, function ($constraint) {
                $constraint->aspectRatio();
                
            })
            ->save($directory.DIRECTORY_SEPARATOR.$filename.'_cardArticle.jpg');
        $manager
            ->make($image)
            ->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
                
            })
            ->save($directory.DIRECTORY_SEPARATOR.$filename.'_cardChannel.jpg');    
        $post->setImage($filename);

    }

    public static function detach (Post $post)
    {
        if(!empty($post->getImage())){
            $directory =  UPLOAD_PATH . DIRECTORY_SEPARATOR. 'posts';
            $formats= ['small','cardArticle','cardChannel'];
            foreach($formats as $format){
                $file = $directory. DIRECTORY_SEPARATOR .$post->getImage().'_'.$format.'.jpg';
                if (file_exists($file)){
                     unlink($file);
                }
            }
        }

    }
}