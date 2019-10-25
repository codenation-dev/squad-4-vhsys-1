#!/usr/bin/env bash
function docker_alias() {
    docker run -it --rm --user $(id -u):$(id -g) -v `pwd`:`pwd` -w `pwd`  ${@:1}
}


alias php-5.6='docker_alias webdev:5.6-fpm php'
alias composer-5.6='docker_alias webdev:5.6-fpm composer'

alias php-7.0='docker_alias webdev:7.0-fpm php'
alias composer-7.0='docker_alias webdev:7.0-fpm composer'

alias php-7.1='docker_alias webdev:7.1-fpm php'
alias composer-7.1='docker_alias webdev:7.1-fpm composer'

alias php-7.2='docker_alias webdev:7.2-fpm php'
alias composer-7.2='docker_alias webdev:7.2-fpm composer'

alias php-7.3='docker_alias webdev:7.3-fpm php'
alias composer-7.3='docker_alias webdev:7.3-fpm composer'

alias php-7.4='docker_alias webdev:7.4-fpm php'
alias composer-7.4='docker_alias webdev:7.4-fpm composer'

# Add, in your ~/.bash_profile file this line, replacing ~/PATH_OF_REPOSITORY with the PATH/directory of this repository.
# source ~/PATH_OF_REPOSITORY/aliases.sh
