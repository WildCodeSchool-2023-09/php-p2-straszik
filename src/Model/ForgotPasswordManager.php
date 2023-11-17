<?php

namespace App\Model;

class ForgotPasswordManager extends AbstractManager
{
    public function forgotPassword(string $email, string $password)
    {
        $query = $this->pdo->prepare('UPDATE user SET password = :password WHERE email = :email');
        $query->bindValue(':email', $email);
        $query->bindValue(':password', $password);
        return $query->execute();
    }

    public function verifyEmail(string $email)
    {
        $query = $this->pdo->prepare('SELECT email FROM user WHERE email = :email');
        $query->bindValue(':email', $email);
        $query->execute();
        return $query->fetch();
    }
}
