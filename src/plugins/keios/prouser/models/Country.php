<?php namespace Keios\ProUser\Models;

use Form;
use Model;

/**
 * Country Model
 */
class Country extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'keios_prouser_countries';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['name', 'code'];

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required',
        'code' => 'unique:keios_prouser_countries',
    ];

    /**
     * @var array Relations
     */
    public $hasMany = [
        'states' => ['Keios\ProUser\Models\State']
    ];

    /**
     * @var bool Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    /**
     * @var array Cache for nameList() method
     */
    protected static $nameList = null;

    /**
     * @return array
     */
    public static function getNameList()
    {
        if (self::$nameList)
            return self::$nameList;

        return self::$nameList = self::isEnabled()->lists('name', 'id');
    }

    /**
     * @param       $name
     * @param null  $selectedValue
     * @param array $options
     *
     * @return string
     */
    public static function formSelect($name, $selectedValue = null, $options = [])
    {
        return Form::select($name, self::getNameList(), $selectedValue, $options);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeIsEnabled($query)
    {
        return $query->where('is_enabled', true);
    }

}