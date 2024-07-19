{
  pkgs,
  lib,
  config,
  inputs,
  ...
}: let
  php = pkgs.php83.buildEnv {
    extensions = {
      all,
      enabled,
    }:
      with all;
        enabled
        ++ [
          pcntl
          pcov
        ];
  };
in {
  packages = with pkgs; [
    git
    php83Extensions.xdebug
    php83Packages.composer
    fswatch
  ];

  languages.php = {
    enable = true;
    package = php;
  };

  pre-commit.hooks.pint = {
    enable = true;
    name = "pint";
    description = "Run Pint on all changed files";
    files = "\.php$";
    entry = "./vendor/bin/pint --dirty --";
  };
}
