<?php
namespace App\Model;

use DateTime;
use App\Helpers\Text;

class Post {

    private $id;

    private $name_video;

    private $name_author;

    private $content;

    private $created_at;

    private $modified_date;

    private $i_frame;

    private $path_youtube;

    private $slug;

    private $image;

    private $oldImage;

    private $pendingUpload = false;

    private $categories = [];

        public function __construct()
        {

        }
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }


    public function getName_video(): ?string
    {
        return $this->name_video;
    }

    public function setName_video(string $name_video):self
    {
        $this->name_video = $name_video;
        
        return $this;
    }

    public function getName_author(): ?string
    {
        return $this->name_author;
    }

    public function setName_author($name_author)
    {
        $this->name_author = $name_author;
      
        return $this;
    }

    public function getExcerpt (): ?string
    {
        if($this->content===null){
            return null;
        }
        return nl2br(htmlentities(Text::excerpt($this->content, 200)));
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        
        return $this;
    }

    public function getCreated_at(): DateTime
    {
        return new DateTime($this->created_at);
    }

    public function setCreated_at(string $date)
    {
        $this->created_at = $date;

        return $this;
    }

    public function getModified_date()
    {
        return $this->modified_date;
    }

    public function setModified_date($modified_date)
    {
        $this->modified_date = $modified_date;

        return $this;
    }

    public function getI_frame(): ?string
    {
        return $this->i_frame;
    }

    public function setI_frame($i_frame)
    {
        $this->i_frame = $i_frame;

        return $this;
    }

    public function getPath_youtube(): ?string
    {
        return $this->path_youtube;
    }

    public function setPath_youtube($path_youtube)
    {
        $this->path_youtube = $path_youtube;

        return $this;
    }


    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }


    /**
     *  @return Category[] 
     */
   
    public function getCategories() : array
    {
        return $this->categories;
    }
    public function getCategoriesIds () : array
    {
        $ids = [];
        foreach($this->categories as $category) {
            $ids [] = $category->getID();
        }
        return $ids;
    }

    public function setCategories(array $categories): self
    {
        $this->categories = $categories;
        return $this;
    }

    public function addCategory (Category $category):void
    {
        $this->categories[] = $category;
        $category->setPost($this);
    }


    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getImageURL(string $format): ?string
    {
        if(empty($this->image)){
            return null;
        }
        return '/uploads/posts/'.$this->image.'_'.$format.'.jpg';
    }

    public function setImage($image):self
    {
        if(is_array($image) && !empty($image['tmp_name'])){
            if(!empty($this->image)){
                $this->oldImage = $this->image;
            }
            $this->pendingUpload = true;
            $this->image = $image['tmp_name'];
        }

        if(is_string($image) && !empty($image)){
            $this->image = $image;
        }
        return $this;
    }

    public function getOldImage(): ?string
    {
        return $this->oldImage;
    }

    public function shouldUpload(): bool
    {
        return $this->pendingUpload;
    }


}