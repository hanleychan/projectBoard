<?php

namespace App\Policies;

use App\User;
use App\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if a user can edit a project post
     */
    public function editPost(User $user, Project $project)
    {
        return $user->id === $project->user_id && $project->open;    
    }

    /**
     * Determine if a user can delete a project post
     */
    public function deletePost(User $user, Project $project)
    {
        return $user->id === $project->user_id;    
    }

    /**
     * Determine if a user can repost a closed posting
     */
    public function repostPost(User $user, Project $project)
    {
    	return $user->id === $project->user_id && !$project->open;
    }
}
