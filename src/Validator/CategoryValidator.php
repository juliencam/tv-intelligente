<?php
namespace App\Validator;

use App\Table\CategoryTable;

class CategoryValidator extends AbstractValidator  {
    
    public function __construct(array $data, CategoryTable $table, ?int $postID = null)
    {
        parent::__construct($data);
        $this->validator->rule('required', ['name', 'slug']);
        $this->validator->rule('slug', 'slug');
        $this->validator->rules([
            'lengthBetween' => [
                ['name', 3, 200],
                ['slug', 3, 200]
            ]
        ]);
        $this->validator->rule(function($field , $value) use ($table, $postID){

            return !$table->exists($field, $value, $postID);
            
        },['slug', 'name'], 'Cette valeur est déjà utilisé');
        
    }

}