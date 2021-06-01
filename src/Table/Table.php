<?php
namespace App\Table;

use PDO;
use Exception;
use App\Table\Exception\NotFoundException;


abstract class Table {

    protected $pdo;
    protected $table = null;
    protected $class = null;

    public function __construct(PDO $pdo)
    {
        if($this->table === null){
            throw new Exception("la class ". get_class($this). " n'a pas de propriété \$table");
        }
        if($this->class === null){
            throw new Exception("la class ". get_class($this). " n'a pas de propriété \$class");
        }
        $this->pdo = $pdo;
    }

    public function find (int $id)
    {
        $query = $this->pdo->prepare('SELECT * FROM '. $this->table.' WHERE id = :id');
        $query->execute(['id' => $id]);
        $query->setFetchMode(PDO::FETCH_CLASS, $this->class);
       
        $post = $query->fetch();
        if ($post === false){
            throw new NotFoundException($this->table, $id );
        }
        return $post;
    }

    public function create (array $data) : int
    {    
        $sqlFields=[];
        foreach($data as $key => $value){
            $sqlFields[] = "$key = :$key";
           
        }   
        $query = $this->pdo->prepare(" INSERT INTO {$this->table} SET " .implode (', ',$sqlFields));
        $ok = $query->execute($data);    
            if ($ok === false){ 
                throw new Exception("Impossible de créer l'enregistrement dans la table {$this->table}");
            }
        return (int)$this->pdo->lastInsertId();    
    }

    public function exists(string $field ,$value, ?int $except = null): bool
    {
        $sql = "SELECT COUNT(id) FROM {$this->table} WHERE $field = ?";
        $params = [$value];
        if($except !== null){
            $sql .= " AND id != ?";
            $params[] = $except; 
        }
        $query =$this->pdo->prepare($sql);
        $query->execute($params);
        return (int)$query->fetch(PDO::FETCH_NUM)[0] > 0;

    }

    public function update(array $data, $id):void
    {
        $sqlFields=[];
        foreach($data as $key => $value){
            $sqlFields[] = "$key = :$key";
           
        }   
       
        $query = $this->pdo->prepare(" UPDATE {$this->table} SET " .implode (', ',$sqlFields)." WHERE id = :id");
        
        $ok = $query->execute(array_merge($data, ['id' => $id]));   
        if ($ok === false){ 
            throw new Exception("Impossible de mettre à jour l'enregistrement dans la table {$this->table}");
        }
           
    }
    
    public function delete(int $id): void
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $supPost = $query->execute([$id]);
        if ($supPost === false){
            throw new Exception("Impossible de supprimer l'enregistrement $id dans la table {$this->table}");
        }

    }

    public function all()
    {
       $sql =  " SELECT * FROM {$this->table} ";
       return $this->pdo->query($sql, PDO::FETCH_CLASS, $this->class )->fetchAll();
    }

    public function queryAndFetchAll(string $sql): array
    {
        return $this->pdo->query($sql, PDO::FETCH_CLASS, $this->class )->fetchAll();
    }

}