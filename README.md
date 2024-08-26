
# Teste de desenvolvimento de uma api de maquiagem

## Descrição
Uma API (Interface de Programação de Aplicativos) para uma loja de maquiagem serve como um intermediário entre o banco de dados da loja e um serviço externo. Ela permite que diferentes plataformas, como aplicativos mobile, sites e sistemas de gestão, acessem e manipulem dados sobre produtos, clientes, pedidos e outras informações relevantes de forma padronizada e eficiente.

## O que foi utilizado
Antes de começar a usar este projeto, é necessário ter o seguinte configurado em seu ambiente de desenvolvimento:

- PHP (versão 8.3 ou superior)
- Composer 2
- Laravel (versão 11.x)
- Banco de dados MySQL
- Docker e Docker-Compose
- [MakeUp Api](https://makeup-api.herokuapp.com/)

## Funcionalidades
- Produtos
- Tipos de produto
- Categoria de produto
- Marcas

## Atividades
- [x]  - Consultar dados de uma api pública
- [x]  - Importação de produtos, marcas e categorias
- [x]  - Importação de marcas
- [x]  - Importação de categorias
- [x]  - Desenvolver uma função automatizada para salvar os dados da api externa ao banco de dados

## Instalação

Siga as etapas abaixo para configurar o projeto em seu ambiente local:

1. Clone este repositório para sua máquina local:

```
git clone https://github.com/RayconBatista/test-makeup-lara-api.git
```

2. Navegue até o diretório do projeto:

```
cd test-makeup-lara-api
```

3. Crie um arquivo `.env` na raiz do projeto e configure-o com as informações do seu ambiente, incluindo as credenciais do banco de dados. 

4. Inicie o servidor de desenvolvimento com os containers do docker. usando o comando pela primeira vez
```
docker-compose up -d
```

5. Acesse o container da aplicação laravel
```
docker-compose exec app bash
```

### Dentro do container
6. Instale as dependências do Composer com o comando:

```
composer install
```

5. Gere a chave de aplicativo Laravel:

```
php artisan key:generate
```
6. Execute as migrações do banco de dados para criar as tabelas necessárias:

```
php artisan migrate
```

7. Se necessário, execute os *seeders* para preencher o banco de dados com dados de exemplo:

```
php artisan db:seed
```


O projeto estará acessível em `http://localhost:8099`.