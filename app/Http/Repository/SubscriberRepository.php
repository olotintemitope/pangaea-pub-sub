<?php


namespace App\Http\Repository;


use App\Http\Contracts\BaseModelInterface;
use App\Models\Topic;

class SubscriberRepository implements BaseModelInterface
{
    /**
     * @var Topic
     */
    private $topic;

    public function __construct(Topic $topic)
    {
        $this->topic = $topic;
    }

    public function create(array $attributes)
    {
        return $this->topic->create($attributes);
    }

    public function findOne(int $id)
    {
        return $this->topic->find($id);
    }
}
