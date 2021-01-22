# Projeto Magento 2.

## Descrição
Neste projeto foi realizado a criação de dois websites utilizando Magento 2 e a criação de um Block Data, a configuração e customização dos dois websites foi  através do arquivo config.php, um dos websites o " Koala Store" é uma multi-store onde uma das stores views está em inglês e sua moeda é dollar U$, e a segunda store view está em português e sua moeda é real R$.
O segundo website é o "Doctor Fit" ele tem uma store view e seu menu é diferente do primeiro website.
Foi adicionado também custumação por meio de Less e instalação por meio de frete.

## Ferramentas Utilizadas:
Magento 2.4.1,
MySQL 8.0,
PHP 7.4,
Nginx 1.18
Grunt-cli 1.3.2
Composer 1.10.19

## Autores do projeto
Gustavo Menezes, Karen Avelar e Paulo Junior.

## Status
Em andamento.

## Instalação

**Clone o repositório:**

$ git clone https://github.com/pjcesar-dev/magento2.git <NOME DA PASTA>

**Instale o composer:**
$ composer install

**Crie uma nova database no MYSQL:**

$ mysql -u root -p
$ show databases;
$ create database <NOME DA DATABASE> default character set utf8 default collate utf8_general_ci;
$ show databases;
    
**Faça a conexão entre o magento e a database:**

$ php bin/magento setup:install 
--base-url=http://<nomedaloja>.magento2.localhost \
	--db-host=localhost \
	--db-name=magento \
	--db-user=magento \
	--db-password=magento \
	--backend-frontname=admin \
	--admin-firstname=admin \
	--admin-lastname=admin \
	--admin-email=admin@admin.com \
	--admin-user=admin \
	--admin-password=admin123 \
	--language=en_US \
	--currency=USD \
	--timezone=America/Chicago \
	--use-rewrites=1


**Ative o Elasticsearch**

sudo service elasticsearch start


