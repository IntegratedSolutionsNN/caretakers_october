<?php namespace Keios\ProUser\Models;

use Form;
use Model;

/**
 * State Model
 */
class State extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'keios_prouser_states';

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
        'code' => 'required',
    ];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'country' => ['Keios\ProUser\Models\Country']
    ];

    /**
     * @var bool Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    /**
     * @var array Cache for nameList() method
     */
    protected static $nameList = [];

    /**
     * @param $countryId
     *
     * @return mixed
     */
    public static function getNameList($countryId)
    {
        if (isset(self::$nameList[$countryId]))
            return self::$nameList[$countryId];

        return self::$nameList[$countryId] = self::whereCountryId($countryId)->lists('name', 'id');
    }

    /**
     * @param       $name
     * @param null  $countryId
     * @param null  $selectedValue
     * @param array $options
     *
     * @return string
     */
    public static function formSelect($name, $countryId = null, $selectedValue = null, $options = [])
    {
        return Form::select($name, self::getNameList($countryId), $selectedValue, $options);
    }

}