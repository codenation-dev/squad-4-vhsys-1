#!/usr/bin/env bash
function docker_alias() {
    docker run -it --rm --user $(id -u):$(id -g) -v `pwd`:`pwd` -w `pwd`  ${@:1}
}




alias php-7.3='docker_alias webdev:7.3-fpm php'
alias composer-7.3='docker_alias webdev:7.3-fpm composer'



# Add, in your ~/.bash_profile file this line, replacing ~/PATH_OF_REPOSITORY with the PATH/directory of this repository.
# source ~/PATH_OF_REPOSITORY/aliases.sh
