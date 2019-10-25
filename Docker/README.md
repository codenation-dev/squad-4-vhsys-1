# Ambiente de desenvolvimento PHP

Clone este projeto dentro de /var/www

### Criar as Imagens
```sh
docker-compose build
```

### Alias para executar o PHP cli
Adicione, ao seu arquivo ~/.bashrc esta linha.
```sh
source /var/www/webdev/aliases.sh
```

### Adiconar portainer ao arquivo hosts
Adione ao arquivo /etc/hosts a seguinte linha, substituindo SEU_IP pelo IP da sua máquina, e não o 127.0.0.1. 
```
SEU_IP          portainer.docker.local
192.168.0.10    example.docker.local
```

Criar seus hosts virtuais dentro do diretorio /var/www/webdev/nginx/conf.d. Pois o mesmo já está mapeada no container em sua respectiva pasta.


### Subir o ambiente
```sh
docker-compose up -d
```

Acesse seu navegador e digite https://portainer.docker.local

### Baixar o ambiente
```sh
docker-compose down
```
