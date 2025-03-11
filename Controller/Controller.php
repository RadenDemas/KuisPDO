<?php
    require "../Model/ModelData.php";
    require "../Model/ModelCategory.php";
    $con = new Connection();
class Controller
{
    private $model;
    private $modelCategory;

    public function __construct()
    {
        $this->model = new ModelData();
        $this->modelCategory = new ModelCategory();
    }

    public function insertProduct($table, $data)
    {
        return $this->model->insertData($table, $data);
    }

    public function insertCategory($table, $data){
        return $this->modelCategory->insertData($table, $data);
    }

    public function getDataProduct($table,$limit,$offset)
    {
        return $this->model->getData($table,$limit,$offset);
    }

    public function getDataCategory($table,$limit,$offset){
        return $this->modelCategory->getData($table,$limit,$offset);
    }

    public function updateData($table, $data, $id)
    {
        return $this->model->updateData($table, $data, $id);
    }

    public function deleteData($table, $id)
    {
        return $this->model->deleteData($table, $id);
    }

    public function getDataById($table, $id){
        return $this->model->getDataById($table, $id);
    }

    public function countDataProduct($table){
        return $this->model->countData($table);
    }

    public function countDataCategory($table){
        return $this->modelCategory->countData($table);
    }

}