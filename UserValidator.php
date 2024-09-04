<?php

class UserValidator
{
    public function validateEmail(string $email): bool
    {
        $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        return preg_match($pattern, $email) === 1;
    }

    public function validatePassword(string $password): bool
    {
        if (strlen($password) < 8) {
            return false;
        }

        $containsUpperCase = preg_match('/[A-Z]/', $password);
        $containsLowerCase = preg_match('/[a-z]/', $password);
        $containsDigit = preg_match('/\d/', $password);
        $containsSpecialChar = preg_match('/[\W_]/', $password);

        return $containsUpperCase && $containsLowerCase && $containsDigit && $containsSpecialChar;
    }
}
