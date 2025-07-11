<?php
namespace App\Interfaces;
interface LaptopRepositoryInterface
{
    public function getAll(array $filters = [], array $sort = [], int $perPage = 10);

    public function findById(int $id);

    public function create(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);

    public function searchLaptops(string $query, array $filters = [], array $sort = [], int $perPage = 10);
}
