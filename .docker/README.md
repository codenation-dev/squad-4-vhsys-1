# Ambiente de desenvolvimento 

entre em  /var/www
```sh
cd /var/wwww
```
Clone o projeto 
```sh
git clone https://github.com/codenation-dev/squad-4-vhsys-1.git
```

Instale as dependências
```sh
cd squad-4-vhsys-1
composer install
```

### Adiconar portainer  e acesso local ao arquivo hosts
Adione ao arquivo /etc/hosts a seguinte linha, substituindo SEU_IP pelo IP da sua máquina, e não o 127.0.0.1. 
```
SEU_IP          portainer.docker.local
SEU_IP          aceleradev-squad4.docker.local
```


### Criar as Imagens
Acesse a pasta .docker

```sh
cd /var/www/squad-4-vhsys-1/.docker
```

```sh
docker-compose build
```

### Alias para executar o PHP cli
Adicione, ao seu arquivo ~/.bashrc esta linha.
```sh
source /var/www/squad-4-vhsys-1/.docker/aliases.sh
```

### Subir o ambiente
```sh
docker-compose up -d
```


### Baixar o ambiente
```sh
docker-compose down
```
