<?php
namespace App\Validator;

use App\Table\PostTable;

class PostValidator extends AbstractValidator  {
    
    public function __construct(array $data, PostTable $table, ?int $postID = null, array $categoriesIds)
    {
        parent::__construct($data);
        $this->validator->rule('required', ['name_video', 'slug', 'name_author','content','created_at','i_frame', 
                                            'path_youtube']);
        $this->validator->rule('slug', 'slug');
        $this->validator->rule('image', 'image');
        $this->validator->rule('subset', 'categoriesids',array_keys($categoriesIds) );
        $this->validator->rules([
            'dateFormat' => [
                ['created_at', 'Y-m-d H:i:s']
            ]
        ]);
        $this->validator->rules([
            'lengthBetween' => [
                ['name_video', 3, 200],
                ['slug', 3, 200],
                ['name_author', 2, 100],
                ['content', 2, 6000],
                ['i_frame', 2, 1000],
                ['path_youtube', 2, 1000]
            ]
        ]);
        $this->validator->rule(function($field , $value) use ($table, $postID){

            return !$table->exists($field, $value, $postID);
            
        },['slug', 'name_video', 'i_frame'], 'Cette valeur est déjà utilisé');
        
    }

}