<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Contracts\BaseContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository implements BaseContract
{
    public function __construct(
        protected Model $model
    ) {}

    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }

    public function findAll(): Collection
    {
        return $this->model->get();
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): Model
    {
        $model = $this->model->query()
                    ->where('id', $id)
                    ->firstOrFail();

        $model->update($data);

        return $model;
    }

    public function delete(int $id): bool|null
    {
        $model = $this->model->find($id);
        return $model->delete();
    }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->model->paginate($perPage);
    }

    // Metodo generico per eseguire una WHERE su un campo specifico
    public function searchByField(string $field, string $search): Collection
    {
        return $this->model->where($field, 'LIKE', "%$search%")->get();
    }

    // Metodo con paginazione
    public function searchByFieldPaginated(string $field, string $search, int $paginationCount = 10): LengthAwarePaginator
    {
        return $this->model->where($field, 'LIKE', "%$search%")->paginate($paginationCount);
    }

    public function getWithRelations(array $relations = [], ?int $perPage = null)
    {
        $query = $this->model->with($relations);

        return $perPage ? $query->simplePaginate($perPage) : $query->get();
    }

    public function applySorting($query)
    {
        $sortBy = request()->query('sort_by', 'id'); // Default: id
        $order = request()->query('order', 'asc'); // Default: asc

        // Aggiungi la logica per validare i campi ordinabili
        $sortableFields = $this->model->getSortableFields();

        if (in_array($sortBy, $sortableFields)) {
            $query->orderBy($sortBy, $order);
        }

        return $query;
    }

    public function applyIncludes($query)
    {
        $includes = request()->query('include', null);

        if ($includes) {
            $includeFields = explode(',', $includes);
            $query->with($includeFields);
        }

        return $query;
    }


    public function getWithSortingAndIncludes(array $relations = [], ?int $perPage = null)
    {
        $query = $this->model->query();

        // Applica gli includes
        $query = $this->applyIncludes($query);

        // Applica il sorting
        $query = $this->applySorting($query);

        // Applica le relazioni (se specificate)
        if ($relations) {
            $query = $query->with($relations);
        }

        // Gestisce la paginazione se presente
        return $perPage ? $query->simplePaginate($perPage) : $query->get();
    }
}
