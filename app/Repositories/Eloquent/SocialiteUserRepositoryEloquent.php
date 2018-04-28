<?php
namespace Yeelight\Repositories\Eloquent;

use Yeelight\Repositories\Criteria\RequestCriteria;
use Yeelight\Repositories\Interfaces\SocialiteUserRepository;
use Yeelight\Models\SocialiteUser;
use Yeelight\Validators\SocialiteUserValidator;
use Yeelight\Presenters\SocialiteUserPresenter;

/**
 * Class SocialiteUserRepositoryEloquent
 * @package namespace Yeelight\Repositories\Eloquent;
 */
class SocialiteUserRepositoryEloquent extends BaseRepository implements SocialiteUserRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'provider',
        'provider_user_id'
    ];


    /**
     * @var bool
     */
    protected $isSearchableForceAndWhere = true;


    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SocialiteUser::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SocialiteUserValidator::class;
    }


    /**
    * Specify Presenter class name
    *
    * @return mixed
    */
    public function presenter()
    {

        return SocialiteUserPresenter::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}