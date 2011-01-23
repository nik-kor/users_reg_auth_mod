<?php

class RegisterParams
{
    private $questions;

    public function __construct()
    {
        $this->questions = App::getInstance()->getDbConnection()->getRegisterRows();
    }

    public function getAsTableRows()
    {
        foreach($this->questions as $question) {
            $html .= '<tr><td>' . $question['name'] . 
                '</td><td><input type="checkbox" name="question[' . $question['id'] . ']" value="' . $question['id'] . '" /></td></tr>';
        }
    
        return $html;
    }

}
