<?php

    namespace PensionFund\Model;

    use PensionFund\Config;

    class RegistrationModel
    {
        public function insert($data)
        {
            $query = "
                insert into users (
                    firstname,
                    surname,
                    middlename,
                    email,
                    password,
                    role
                ) values (
                    :firstname,
                    :surname,
                    :middlename,
                    :email,
                    :password,
                    case when :isAuthor = 'on' then 1
                         else 0
                    end
                )
            ";

            $dataInsert = [
                'firstname' => $data['firstname'],
                'surname' => $data['surname'],
                'middlename' => $data['middlename'],
                'email' => $data['email'],
                'password' => $data['password'],
                'isAuthor' => $data['isAuthor']
            ];

            try {
                $connection = Config::getDataBaseConnection();
                $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

                return $connection
                    ->prepare($query)
                    ->execute($dataInsert);
            } catch (\PDOException $e) {
                print "Ошибка!: " . $e->getMessage() . "<br/>";
                die();
            }
        }
    }
