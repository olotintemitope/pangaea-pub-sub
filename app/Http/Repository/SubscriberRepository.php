<?php


namespace App\Http\Repository;


use App\Http\Contracts\BaseModelInterface;
use App\Models\Subscriber;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SubscriberRepository implements BaseModelInterface
{
    /**
     * @var Subscriber
     */
    private $subscriber;

    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    public function create(array $attributes)
    {
        return $this->subscriber->create($attributes);
    }

    public function findOne(int $id)
    {
        return $this->subscriber->find($id);
    }
}
