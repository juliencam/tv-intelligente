<?php
namespace App\Model;

use App\Helpers\Text;

class VideoHeader {

    private $id;
    private $name_video;
    private $content;
    private $i_frame;

    public function __construct()
    {
        
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName_video(): ?string
    {
        return $this->name_video;
    }
 
    public function getContent(): ?string
    {
        return nl2br(htmlentities($this->content));
    }

    public function getI_frame(): ?string
    {
        return $this->i_frame;
    }
    public function getExcerpt (): ?string
    {
        if($this->content===null){
            return null;
        }
        return nl2br(htmlentities(Text::excerpt($this->content, 260)));
    }
}