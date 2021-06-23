<?php
class Configuration {
  public $dir_env;

  public function __construct($dir_env) {
    global smarty;
    $dt = $this->configureDotEnv($dir_env);
  }

  private function configureDotEnv($dir_env){
    $dotenv = Dotenv\Dotenv::createImmutable($dir_env);
    dotenv->load(true);
  }
}
?>
