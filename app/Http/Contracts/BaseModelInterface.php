<?php

namespace App\Http\Contracts;

/**
 * Interface BaseModelInterface
 * @package App\Http\Contracts
 */
interface BaseModelInterface
{
    /**
     * Create a new model
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Find a single model
     *
     * @param int $id
     * @return mixed
     */
    public function findOne(int $id);
}
