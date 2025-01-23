<?php
namespace M2i\Core\ORM;

use PDO;

class DAO

{
    public function __construct(
        private PDO $pdo,
        private QueryBuilder $queryBuilder,
        private string $tableName)
    {}

    private function executeSelectQuery(string $sql, Array $params = [], bool $onlyOne = false): array
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);

        if ($onlyOne) {
            return $statement->fetch($this->pdo::FETCH_ASSOC);
        }
        return $statement->fetchAll($this->pdo::FETCH_ASSOC);
    }

    private function executeQuery(string $sql, Array $params = []): int
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);
        return $this->pdo->lastInsertId();
    }

    public function findOneById(int $id) {
       $sql = $this->queryBuilder->select($this->tableName)
                                 ->addWhere("id = ?")
                                 ->getQuery();

       return $this->executeSelectQuery($sql, [$id], true);
    }
    public function findAll() {
        $sql = $this->queryBuilder->select($this->tableName)->getQuery();

        return $this->executeSelectQuery($sql);
    }

    public function find($whereClauses)
    {
        $sql = $this->queryBuilder->select($this->tableName)
                                 ->addWhere($whereClauses)
                                 ->getQuery();
        return $this->executeSelectQuery($sql);
    }

    public function deleteOneById(int $id){
        $sql = $this->queryBuilder->delete()
                                ->from($this->tableName)
                                 ->addWhere("id = ?")
                                 ->getQuery();
        $this->executeQuery($sql, [$id]);
    }

    public function update(array $data, $whereClauses){
        $sql = $this->queryBuilder->update()
                                ->from($this->tableName)
                                 ->setFields(array_keys($data))
                                 ->addWhere($whereClauses)
                                 ->getQuery();
        $this->executeQuery($sql, array_values($data));
    }

    public function insert(array $data){
        $sql = $this->queryBuilder->insert()
                    ->from($this->tableName)
                    ->setFields(array_keys($data))
                    ->getQuery();
        return $this->executeQuery($sql, array_values($data));
    }
}