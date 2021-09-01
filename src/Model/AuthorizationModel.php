<?php

    namespace PensionFund\Model;

    use PensionFund\Config;

    class AuthorizationModel
    {
        public function get($login, $password)
        {
            $query = "
                select *
                  from users
                 where 1 = 1
            ";

            if (!empty($login)) {
                $query .= " and email = '" . $login . "'";
            }
            if (!empty($password)) {
                $query .= " and password = '" . $password . "'";
            }

            try {
                $connection = Config::getDataBaseConnection();
                $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

                $result = $connection->query($query);

                if ($result) {
                    $result = $result->fetch(\PDO::FETCH_ASSOC);
                }

                return $result;
            } catch (\PDOException $e) {
                print "Ошибка!: " . $e->getMessage() . "<br/>";
                die();
            }
        }
    }
