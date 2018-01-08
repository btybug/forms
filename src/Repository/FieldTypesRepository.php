<?php
namespace BtyBugHook\Blog\Repository;

use Btybug\btybug\Repositories\GeneralRepository;
use BtyBugHook\Blog\Models\Post;

class PostsRepository extends GeneralRepository
{
    /**
     * @return mixed
     */
    public function getGroupedWithAuthor($id)
    {
        return $this->model->where('author_id', $id)->get();
    }

    public function getPublished()
    {
        return $this->model->where('status', 'published')->orWhere('status',1)->get();
    }

    public function getPublishedByUrl($slug)
    {
        return $this->model->where('status', 'published')->where('slug',$slug)->first();
    }

    public function model()
    {
        return new Post();
    }
}