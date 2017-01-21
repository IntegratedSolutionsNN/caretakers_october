<?php namespace Keios\ProUser\Models;

use Mail;
use October\Rain\Auth\Models\User as UserBase;
use Keios\ProUser\Models\Settings as UserSettings;
use Cache;
use DB;

/**
 * Class User
 *
 * @package Keios\ProUser\Models
 */
class User extends UserBase
{
    /**
     * @var string The database table used by the model.
     */
    protected $table = 'keios_prouser_users';

    /**
     * Validation rules
     */
    public $rules = [
        'email'                 => 'required|between:3,64|email|unique:keios_prouser_users',
        'first_name'            => 'required|between:2,64', // we must be tolerant and accept digits in name
        'last_name'             => 'required|between:2,64', // and in last name too, you facist scum
        'username'              => 'required|between:2,64|unique:keios_prouser_users',
        'password'              => 'required:create|between:4,64|confirmed',
        'password_confirmation' => 'required_with:password|between:4,64'
    ];

    /**
     * @var array
     */
    public $customMessages = [
        'required'      => 'keios.prouser::lang.validation.required',
        'required_with' => 'keios.prouser::lang.validation.required_with',
        'numeric'       => 'keios.prouser::lang.validation.numeric',
        'alpha'         => 'keios.prouser::lang.validation.alpha',
        'email'         => 'keios.prouser::lang.validation.email',
        'between'       => 'keios.prouser::lang.validation.between',
        'unique'        => 'keios.prouser::lang.validation.unique',
        'confirmed'     => 'keios.prouser::lang.validation.confirmed'
    ];

    /**
     * @var array
     */
    public $attributeNames = [
        'first_name'            => 'keios.prouser::lang.formFields.first_name',
        'last_name'             => 'keios.prouser::lang.formFields.last_name',
        'username'              => 'keios.prouser::lang.formFields.username',
        'email'                 => 'keios.prouser::lang.formFields.email',
        'password'              => 'keios.prouser::lang.formFields.password',
        'password_confirmation' => 'keios.prouser::lang.formFields.password_confirmation',
    ];

    /**
     * @var array Relations
     */
    public $belongsToMany = [
        'groups' => ['Keios\ProUser\Models\Group', 'table' => 'keios_prouser_user_group', 'otherKey' => 'group_id']
    ];

    /**
     * @var array
     */
    public $belongsTo = [
        'country' => ['Keios\ProUser\Models\Country'],
        'state'   => ['Keios\ProUser\Models\State'],
    ];

    /**
     * @var array
     */
    public $attachOne = [
        'avatar' => ['System\Models\File']
    ];

    /**
     * @var array The attributes that are mass assignable.
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'username',
        'password',
        'password_confirmation'
    ];

    /**
     * Purge attributes from data set.
     */
    protected $purgeable = ['password_confirmation'];

    /**
     * @var null
     */
    public static $loginAttribute = null;

    /**
     * @return string Returns the name for the user's login.
     */
    public function getLoginName()
    {
        if (static::$loginAttribute !== null) {
            return static::$loginAttribute;
        }

        return static::$loginAttribute = UserSettings::get('login_attribute', UserSettings::LOGIN_EMAIL);
    }

    /**
     * @param array $newFillables
     *
     * @return null
     */
    public function extendFillableFields(array $newFillables)
    {
        $this->fillable = array_merge($this->fillable, $newFillables);
    }

    /**
     * Before validation event
     *
     * @return void
     */
    public function beforeValidate()
    {
        if (!$this->username) {
            $this->username = $this->email;
        }
    }
    
    /**
     *
     */
    public function afterSave()
    {
        \Cache::forget('keios.prouser::user_'.$this->id);
    }

    /**
     * Deletes import status after user removal
     */
    public function afterDelete()
    {
        DB::table('keios_prouser_import_status')->where('user_id', $this->id)->delete();
    }

    /**
     * @return array
     */
    public function getCountryOptions()
    {
        return Country::getNameList();
    }

    /**
     * @return mixed
     */
    public function getStateOptions()
    {
        return State::getNameList($this->country_id);
    }

    /**
     * Get mutator for giving the activated property.
     *
     * @param mixed $blocked
     *
     * @return bool
     */
    public function getIsBlockedAttribute($blocked)
    {
        return (bool)$blocked;
    }

    /**
     * Gets a code for when the user is persisted to a cookie or session which identifies the user.
     *
     * @return string
     */
    public function getPersistCode()
    {
        if (!$this->persist_code) {
            return parent::getPersistCode();
        }

        return $this->persist_code;
    }


    /**
     * Returns the public image file path to this user's avatar.
     *
     * @param int  $size
     * @param null $default
     *
     * @return string
     */
    public function getAvatarThumb($size = 25, $default = null)
    {
        if ($this->avatar) {
            return $this->avatar->getThumb($size, $size);
        } else {
            return '//www.gravatar.com/avatar/'.md5(strtolower(trim($this->email))).'?s='.$size.'&d='.urlencode(
                $default
            );
        }
    }

    /**
     * @param $relations
     */
    public function alwaysEagerLoad($relations)
    {
        if (!is_array($relations)) {
            $relations = [$relations];
        }

        $this->with = array_merge($this->with, $relations);
    }

    /**
     * @param $groupName
     *
     * @return bool
     */
    public function hasGroup($groupName)
    {
        foreach ($this->getGroups() as $_group) {
            if ($_group->name === $groupName) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param array $data
     */
    public function buildRelatedModels(array $data)
    {
        $relations = [];
        $permittedRelations = ['hasMany', 'hasOne', 'attachOne', 'attachMany', 'morphOne', 'morphMany'];

        /*
         * Find relations and fields from related models
         */
        foreach ($data as $field => $value) {
            if (is_array($value)) {
                $relation = $field;

                if (is_null($relationDefinition = $this->getRelationDefinition($relation))) {
                    continue;
                }

                $relationType = $this->getRelationType($relation);

                if (!in_array($relationType, $permittedRelations)) {
                    continue;
                }

                if (!array_key_exists($relation, $relations)) {
                    $relations[$relation] = [];
                    $relations[$relation]['class'] = $relationDefinition[0];
                    $relations[$relation]['fields'] = [];
                }

                foreach ($value as $trueField => $fieldValue) {
                    $relations[$relation]['fields'][$trueField] = $fieldValue;
                }
            }
        }

        /*
         * Apply related models to user account
         */
        foreach ($relations as $relation => $relationData) {
            $relatedModelClass = $relationData['class'];
            $relatedModelInstance = new $relatedModelClass($relationData['fields']);
            $relatedModelInstance->user = $this;
            $relatedModelInstance->save();
        }
    }

    /**
     * @param array $data
     */
    public function updateRelatedModels(array $data)
    {
        $relations = [];
        $permittedRelations = ['hasOne', 'attachOne', 'morphOne'];

        /*
         * Find relations and fields from related models
         */
        foreach ($data as $field => $value) {
            if (is_array($value)) {
                $relation = $field;

                $relationType = $this->getRelationType($relation);

                if (!in_array($relationType, $permittedRelations)) {
                    continue;
                }

                if (!array_key_exists($relation, $relations)) {
                    $relations[$relation] = [];
                }

                foreach ($value as $trueField => $fieldValue) {
                    $relations[$relation][$trueField] = $fieldValue;
                }
            }
        }

        /*
         * Apply related models to user account
         */

        foreach ($relations as $relation => $relationData) {
            $relatedModel = $this->$relation;
            $relatedModel->save($relationData);
        }

    }

}
