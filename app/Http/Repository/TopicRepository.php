<?php


namespace App\Http\Repository;


use App\Http\Contracts\BaseModelInterface;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TopicRepository implements BaseModelInterface
{
    /**
     * @var Topic
     */
    private $topic;

    /**
     * TopicRepository constructor.
     * @param Topic $topic
     */
    public function __construct(Topic $topic)
    {
        $this->topic = $topic;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->topic->create($attributes);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findOne(int $id)
    {
        return $this->topic->find($id);
    }

    /**
     * @param $slug
     * @return Builder|Model|object|null
     */
    public function slug($slug)
    {
        return $this->topic
            ->newQuery()
            ->where('slug', strtolower($slug))
            ->first();
    }
}
