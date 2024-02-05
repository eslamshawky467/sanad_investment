<?php
namespace App\Repository;


interface AdminRepositoryInterface{
    public function index();
    public function create();
    public function store( $request);
    public function editsearch($id);
    public function update($request);
    public function bulkDelete();
    public function search($request);
    public function deletesearch($id);
    public function profile();
    public function overview();
    public function createPDF();


}



