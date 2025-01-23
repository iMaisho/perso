<?php

class QueryBuilder{
    private static array $allowedVerbs = ["SELECT", "ORDERBY", "DELETE", "UPDATE", "INSERT", "WHERE"];
    private array $fieldNames = [];
    private string $verb;
    private array $limit = [];
    private array $orderBy = [];
    private array $whereClauses = [];
    private string $tableName = "";

    public function getQuery(){
        // SELECT fieldNames FROM tableName LIMIT limit[0] OFFSET limit[1] WHERE whereclauses[0] AND .... ORDERBY orderby[0] orderby[1]
        



    }

    public function select($tableName): void{
        $this->verb = "SELECT";
        if ($tableName != ""){
            $this->tableName = $tableName;
        }
    }

    public function insert(): void{
        $this->verb = "INSERT";
    }

    public function delete(): void{
        $this->verb = "DELETE";
    }

    public function update(): void{
        $this->verb = "UPDATE";
    }

    public function addField(string $fieldName): void{
        $this->fieldNames[] = $fieldName;
    }

    public function setFields(array $fieldNames): void{
        $this->fieldNames = $fieldNames;
    }
    public function from(string $tableName): void{
        $this->tableName = $tableName;
    }

    public function limit(int $limit, int $offset = 0){
        $this->limit = [$limit, $offset];
    }

    public function addWhere(string $clause){
        $this->whereClauses[] = $clause;
    }

    public function addOrderBy(string $fieldName, string $direction){
        $this->orderBy = [$fieldName, $direction];
    }

    private function getORDERBYClause(){

    }

    private function getDELETEQuery(){

    }

    private function getSELECTQuery(){

    }

    private function getUPDATEQuery(){

    }

    private function getFieldList(){

    }

    private function getINSERTQuery(){

    }

    private function getWHEREClause(){
    }
}