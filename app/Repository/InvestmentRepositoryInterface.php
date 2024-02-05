<?php
namespace App\Repository;
interface InvestmentRepositoryInterface{
    public function index();
    public function editinvestment($id);
    public function update($request);
    public function bulkDelete();
    public function search($request);
    public function deleteinvestment($id);
    public function approved($id);
    public function canceled($id);
    public function show_investments($id);
}
