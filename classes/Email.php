<?php


class Email
{
  private string $email;

  public function __construct(string $email)
  {
    $this->email = $email;

    if (!$this->isValid()) {
      throw new InvalidArgumentException();
    }
    if(!$this->spam()){
      throw new DomainException();
    }

  }

  private function spam():bool
  {
    $spamChecker = new SpamChecker;
    return (!$spamChecker->isSpam($this))? true : false;
  }

  private function isValid(): bool
  {
    return filter_var($this->email, FILTER_VALIDATE_EMAIL) !== false;
  }

  public function getEmail(): string
  {
    return $this->email;
  }

  public function setEmail(string $email): self
  {
    $this->email = $email;

    return $this;
  }
  public function getDomain():string
  {
    $emailParts = explode('@', $this->email);
    return $emailParts[1];
  }

}
