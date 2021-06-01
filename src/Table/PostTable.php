<?php
namespace App\Table;


use App\Model\Post;
use App\PaginatedQuery;
use Exception;

final class PostTable extends Table {

    protected $table = "post";
    protected $class = Post::class;

    public function attachCategories(int $id, array $categories)
    {
        $this->pdo->exec(' DELETE FROM post_category WHERE post_id = '. $id);
            $query = $this->pdo->prepare(' INSERT INTO post_category SET post_id = ?, category_id = ?');
            foreach($categories as $category){
                $query->execute([$id, $category]);
            }
    }

    public function createPost (Post $post)
    {
       $id = $this->create([
            'name_author'=> $post->getName_author(),
            'name_video'=> $post->getName_video(),
            'slug'=> $post->getSlug(),
            'i_frame'=>$post->getI_frame(),
            'path_youtube'=>$post->getPath_youtube(),
            'content' => $post->getContent(),
            'created_at'=> $post->getCreated_at()->format('Y-m-d H:i:s'),
            'image'=>$post->getImage()
            ]);
            $post->setId($id);
    }
    
    public function updatePost(Post $post):void
    {
        $this->update([
        'name_video'=> $post->getName_video(),
        'name_author'=> $post->getName_author(),
        'content' => $post->getContent(),
        'created_at'=> $post->getCreated_at()->format('Y-m-d H:i:s'),
        'i_frame'=>$post->getI_frame(),
        'path_youtube'=>$post->getPath_youtube(),
        'slug'=> $post->getSlug(),
        'image'=>$post->getImage()
        ],
        $post->getId());
    }

    public function findPaginated(){

        $paginatedQuery = new PaginatedQuery(
            "SELECT * FROM {$this->table} ORDER BY created_at DESC",
            "SELECT COUNT(id) FROM {$this->table} ",
            $this->pdo
        );
        
        $posts = $paginatedQuery->getItems($this->class);
        (new CategoryTable($this->pdo))->hydratePosts($posts);
        return[$posts , $paginatedQuery];
    }

    public function findPaginatedCategory(int $categoryID)
    {
        $paginatedQuery = new PaginatedQuery(
            " SELECT p.* 
                FROM {$this->table} p
                JOIN post_category pc ON pc.post_id = p.id 
                WHERE pc.category_id = {$categoryID}
                ORDER BY created_at DESC",
            " SELECT COUNT(category_id) FROM post_category WHERE category_id = {$categoryID} ",
            $this->pdo
        );
        $posts = $paginatedQuery->getItems($this->class);
        (new CategoryTable($this->pdo))->hydratePosts($posts);
        return[$posts , $paginatedQuery];

    }
    public function findPaginatedChannels(){

        $paginatedQuery = new PaginatedQuery(
            " SELECT * FROM {$this->table} GROUP BY name_author ORDER BY created_at DESC",
            " SELECT COUNT(DISTINCT name_author) FROM {$this->table}",
            $this->pdo
        );
        $posts = $paginatedQuery->getItems($this->class);
        (new CategoryTable($this->pdo))->hydratePosts($posts);
        return[$posts , $paginatedQuery];
    }

    public function deleteLinkTable(int $id): void
    {
        $limit = $this->CountLinkTableByArticle($id);
        $query = $this->pdo->prepare("DELETE FROM post_category WHERE post_id = ? LIMIT {$limit}");
        $supPost = $query->execute([$id]);
        if ($supPost === false){
            throw new Exception("Impossible de supprimer l'enregistrement de liaison $id dans la table {post_category}");
        }
    }

    public function CountLinkTableByArticle(int $id)
    {    
    $count = (int)$this->pdo->query("SELECT COUNT(post_id) FROM post_category WHERE post_id = {$id}")
                             ->fetch(\PDO::FETCH_NUM)[0];
        if ($count === false){
            throw new Exception("Impossible de compter le nombre d'enregistrement de liaison $id dans la table post_category");
        }
        return $count;
    }
}