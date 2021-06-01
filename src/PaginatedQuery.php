<?php
namespace App;
use PDO;
use App\URL;
use Exception;
use App\Connection;
use App\Model\Post ;
class PaginatedQuery{

    private $pdo;
    private $perPage;
    private $count;
    private $items;
    private $getPageForHeaderVideo;

    public function __construct(
        string $query,
        string $queryCount,
        ?PDO $pdo =null,
        int $perPage = 12
    )

    {
        $this->query = $query;
        $this->queryCount = $queryCount;
        $this->pdo = $pdo ?: Connection::getPDO();
        $this->perPage = $perPage;
    }

    public function getItems(string $classMapping)
    {
        if($this->items === null){
            $currentPage = $this->getCurrentPage();
            $pages = $this->getPages();
            
            if($currentPage > $pages){
            throw new Exception('page inexistante');
            }
            
            $offset = (($currentPage-1) * $this->perPage);
           
            if(strpos($_SERVER['REQUEST_URI'], 'admin') ){
                $this->perPage = 12;
            } 
            

            $this->items = $this->pdo->query($this->query. 
                " LIMIT {$this->perPage} OFFSET $offset" )
                ->fetchAll(PDO::FETCH_CLASS, $classMapping);
        }
        
        return $this->items;
    }

    private function getCurrentPage ()
    {
        $this->getPageForHeaderVideo = URL::getpositiveInt('page', 1);
        return URL::getpositiveInt('page', 1);
    }

    private function getPages (): int
    {
        if($this->count === null) {
           $count = $this->count = (int)$this->pdo
                ->query($this->queryCount)
                ->fetch(PDO::FETCH_NUM)[0];      
        }
       
        return  (ceil($this->count / $this->perPage));
    } 

    public function nextLink($link,?string $colorA = null): ?string
    {

        if($colorA === null){
            $colorA = "button";
            }
        else {
            $colorA = 'btn-primary';    
        }
        $currentPage = $this->getCurrentPage();
        $pages = $this->getPages();
        if($currentPage >= $pages ) return null;
            $link .= "?page=".($currentPage + 1); 
            return <<<HTML
            <a href="{$link}" class="btn {$colorA} ml-auto">Page Suivante</a>
HTML;
    }

    public function previousLink($link , ?string $colorA = null): ?string
    {   
        if($colorA === null){
            $colorA = "button";
            }
        else {
            $colorA = 'btn-primary';    
        }
        $currentPage = $this->getCurrentPage();
        if($currentPage <=1) return null;
        if ($currentPage > 2) $link .='?page=' .($currentPage - 1) ;
        return <<<HTML
        <a href="{$link}" class="btn {$colorA}">Page Précédente</a>
HTML;
    }

    public function getPageForHeaderVideo()
    {
        return $this->getPageForHeaderVideo;
    }

    public function getPerPage()
    {   
        return $this->perPage;
    }
}
    





