<?php

use Faker\Guesser\Name;

class Guesser extends Name
{
    public function guessFormat($name)
    {
        $name = strtolower($name);
        $generator = $this->generator;
        if (false !== strpos($name, 'val[email]')) {
            return function () use ($generator) {
                $email = $generator->email;
                ConfirmData::$_email = $email;
                return $email;
            };
        }
        if (false !== strpos($name, 'val[title]')) {
            return function () use ($generator) {
                $title = $generator->text;
                ConfirmData::$_title = $title;
                return $title;
            };
        }
        if (false !== strpos($name, 'phone')) {
            return function () use ($generator) {
                return $generator->phoneNumber;
            };
        }
        if (false !== strpos($name, 'pass')) {
            return function () use ($generator) {
                return $generator->password;
            };
        }
        $return = parent::guessFormat($name);
        if ($return) {
            return $return;
        }

        if (false !== strpos($name, 'val[city_location]')) {
            return function () use ($generator) {
                return $generator->city;
            };
        }
        if (false !== strpos($name, 'val[full_name]')) {
            return function () use ($generator) {
                return $generator->firstName . ' ' . $generator->lastName;
            };
        }

        return false;
    }


}