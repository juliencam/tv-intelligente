<?php
namespace App\Table;

use PDO;
use App\Model\Category;
use App\PaginatedQuery;

final class CategoryTable extends Table{

    protected $table = "category";
    protected $class = Category::class;

    public function hydratePosts ($posts)
    {
        $postByID = [];
        foreach ($posts as $post){

            $post->setCategories([]);

            $postByID [$post->getId()] = $post;
        }
        $categories = $this->pdo->query(
                ' SELECT c.*, pc.post_id
                    FROM post_category pc 
                    JOIN category c ON c.id = pc.category_id
                    WHERE pc.post_id IN (' . implode(",", array_keys($postByID)) . ')'
                    )->fetchAll(PDO::FETCH_CLASS, $this->class);

        foreach($categories as $category){
            $postByID[$category->getPost_id()]->addCategory($category);
        }
    }

    public function findPaginatedAllCategories ()
    {
        $paginatedQuery = new PaginatedQuery(
            " SELECT *
                FROM category
                WHERE id
            ", 
            " SELECT COUNT(id) FROM category WHERE id ",
            $this->pdo
        );
        $allCategories = $paginatedQuery->getItems($this->class);
        return[$allCategories , $paginatedQuery];

    }

    public function all()
    {
     return $this->queryAndFetchAll(" SELECT * FROM {$this->table} ORDER BY id DESC ") ;
    }

    public function list():array
    {
        $categories = $this->queryAndFetchAll(" SELECT * FROM {$this->table} ORDER BY name ASC ");
        $results = [];
        foreach($categories as $categorie){
            $results[$categorie->getId()] = $categorie->getName();
        }
        return $results;
    }

}