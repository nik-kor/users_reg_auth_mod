<?php

class DBConnection 
{
    private $link;
    public function __construct($params)
    {
        $this->link = mysql_connect($params['host'], $params['user_login'], $params['user_password']);
        if (!$this->link) {
            die('Could not connect: ' . mysql_error());
        }

        mysql_query('use ' . $params['db_name']);
    }

    public function __destruct() 
    {
        mysql_close($this->link);    
    }

    public function __toString()
    {
        return __CLASS__;
    }

    public function getRegisterRows()
    {
        $result = mysql_query('select * from register_question', $this->link);
        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }

        while ($row = mysql_fetch_assoc($result)) {
            $arQuestions[] = $row;
        }

        return $arQuestions;
    }

    public function isEmailExists($email) 
    {
        $data = mysql_query('select count(*) as num from user where email = "' . $email . '"') or die(mysql_error());
        $row = mysql_fetch_assoc($data);

        return $row['num'] > 0 ? true : false;
    }

    public function addUser($params)
    {
        mysql_query('insert into user 
                        (email, password) 
                        values ("' . $params['email'] . '", "' .
                                    $this->getPasswordHash($params['password']) . '")', $this->link) or die(mysql_error());

        $user_id = mysql_insert_id($this->link);
        if(is_array($_POST['question'])) {
            foreach($_POST['question'] as $questionId) {
                mysql_query('insert into user_register_question (user_id, register_question_id) 
                            values (' . $user_id . ', ' . $questionId . ')') or die(mysql_error());
            }
        }
    }

    private function getPasswordHash($password) 
    {
        return sha1($password);
    }

    public function getUser($user) 
    {
        $result = mysql_query('select * 
                    from user 
                    where email = "' . $user['email'] . 
                    '" and password = "' . $this->getPasswordHash($user['password']) . '"') 
                    or die(mysql_error());

        if($row = mysql_fetch_assoc($result)) {
            return $row;
        }

        return false;
    }
    
    public function getUserById($userId) 
    {
        $result = mysql_query('select * 
                    from user 
                    where id = ' . $userId) or die(mysql_error());

        if($row = mysql_fetch_assoc($result)) {
            return $row;
        }

        return false;
    }

}
