<?php

    namespace PensionFund\Model;

    use PensionFund\Config;

    class ScheduleModel
    {
        public function get($data)
        {
            $query = "
                select s.id,
                       s.date,
                       s.link,
                       c.name course_name,
                       case when unix_timestamp(s.date) < unix_timestamp(now()) then 0
                            else 1
                       end is_lost
                  from schedule s
                       join courses c on c.id = s.course_id
                       join users a on a.id = c.user_id";

            $query .= !empty($data->user_id) ? ' join claims cl on cl.course_id = s.course_id where 1 = 1' : ' where 1 = 1';


            if (!empty($data->course_id)) {
                $query .= ' and (c.id = ' . $data->course_id . ' or ' . $data->course_id . ' is null)';
            }

            if (!empty($data->user_id)) {
                $query .= ' and cl.user_id = ' . $data->user_id;
            }

            if (!empty($data->author_id)) {
                $query .= ' and c.user_id = ' . $data->author_id;
            }

            $query .= ' order by c.name';   

            try {
                $connection = Config::getDataBaseConnection();
                return $connection
                    ->query($query)
                    ->fetchAll(\PDO::FETCH_ASSOC);
            } catch (\PDOException $e) {
                print "Ошибка!: " . $e->getMessage() . "<br/>";
                die();
            }
        }

        public function insert($data)
        {
            $query = "
                insert into schedule (date, link, course_id)
                    values (:date, :link, :course_id)
            ";

            $dataInsert = [
                'date' => $data->date,
                'link' => $data->link,
                'course_id' => $data->course_id
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

        public function update($data)
        {
            $query = "
                update schedule
                   set date = :date,
                       link = :link,
                       course_id = :course_id
                 where id = :id;
            ";

            $dataUpdate = [
                'id' => $data->id,
                'date' => $data->date,
                'link' => $data->link,
                'course_id' => $data->course_id
            ];

            try {
                $connection = Config::getDataBaseConnection();
                $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

                return $connection
                    ->prepare($query)
                    ->execute($dataUpdate);
            } catch (\PDOException $e) {
                print "Ошибка!: " . $e->getMessage() . "<br/>";
                die();
            }
        }

        public function delete($data)
        {
            $query = "
                delete
                  from schedule
                 where id = :id;
            ";

            $dataDelete = [
                'id' => $data->id
            ];

            try {
                $connection = Config::getDataBaseConnection();
                $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

                return $connection
                    ->prepare($query)
                    ->execute($dataDelete);
            } catch (\PDOException $e) {
                print "Ошибка!: " . $e->getMessage() . "<br/>";
                die();
            }
        }
    }
