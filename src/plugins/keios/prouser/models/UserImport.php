<?php namespace Keios\ProUser\Models;

use DB;
use Backend\Models\ImportModel;
use ApplicationException;
use Keios\ProUser\Models\User;

/**
 * User Import Model
 *
 * @property mixed|string update_existing
 */
class UserImport extends ImportModel
{
    /**
     * @var string
     */
    public $table = 'keios_prouser_users';

    /**
     * Validation rules
     */
    public $rules = [
        'id'        => 'required',
        'email'     => 'required',
        'is_active' => 'required',
    ];

    /**
     * @param      $results
     * @param null $sessionKey
     */
    public function importData($results, $sessionKey = null)
    {
        //  dd($results);
        $firstRow = reset($results);

        $currentEmails = [];
        $currentUsersEmails = \DB::table((new User)->getTable())->select(['email'])->get();
        foreach ($currentUsersEmails as $email) {
            /** @noinspection PhpUndefinedFieldInspection */
            array_push($currentEmails, $email->email);
        }

        foreach ($results as $row => $data) {

            try {
                $exists = null;

                if (!$data['email']) {
                    $this->logSkipped($row, 'Missing user email');
                    continue;
                }

                /*
                 * Find or create
                 */
                $user = new User();

                /** @noinspection PhpUndefinedFieldInspection */
                if ($this->update_existing) {
                    $exists = $this->findDuplicateUser($data, $currentEmails);
                }
                if (!$exists) {
                    $data['username'] = $data['email'];

                    /* todo think about it */
                    $password = substr(hash('sha512', rand()), 0, 12);


                    $user->email = $data['email'];
                    $user->password = $password;
                    $user->password_confirmation = $password;

                    $user = $this->fillUser($user, $data);

                    $user->save();

                    DB::table('keios_prouser_import_status')
                        ->insert(['user_id' => $user->id, 'is_migrated' => false]);

                    $this->logCreated();

                } else {
                    $toUpdate = User::where('email', $data['email'])->first();
                    $user = $this->fillUser($toUpdate, $data);
                    $user->save();
                    $this->logUpdated();
                }

            } catch (\Exception $ex) {
                $this->logError($row, $ex->getMessage());
            }
        }
    }

    /**
     * @param User $user
     * @param array $data
     *
     * @return User
     */
    protected function fillUser($user, $data)
    {
        /* very magic */
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->street = $data['street'];
        $user->house_number = $data['house_number'];
        $user->flat_number = $data['flat_number'];
        $user->city = $data['city'];
        $user->zip = $data['zip'];
        $user->country = $data['country'];
        $user->phone = $data['phone'];
        $user->company_name = $data['company_name'];
        $user->register_number = $data['register_number'];
        $user->vat_number = $data['vat_number'];
        $user->is_company = $data['is_company'];
        $user->wants_invoice = $data['wants_invoice'];
        $user->is_activated = $data['is_activated'];
        $user->is_blocked = $data['is_blocked'];

        return $user;
    }

    /**
     * @param array $data
     * @param array $currentEmails
     *
     * @return \Illuminate\Support\Collection|null|static
     */
    protected function findDuplicateUser($data, $currentEmails)
    {
        if (in_array($data['email'], $currentEmails)) {
            return User::where('email', $data['email'])->first();
        }

        return null;

    }

}