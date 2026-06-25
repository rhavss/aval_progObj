# Rodando o projeto com Docker

Esse guia assume que você já tem o Docker (e o Docker Compose, que já vem
junto no Docker Desktop) instalado e funcionando.

## 1. Copiar os arquivos pro seu projeto

Copie esses arquivos pra **raiz** do seu projeto Laravel (mesma pasta onde
fica o `artisan`, o `composer.json`, etc):

- `Dockerfile`
- `docker-compose.yml`
- `.dockerignore`

## 2. Ajustar o `.env`

Abra o `.env.docker.exemplo` que veio aqui e copie o conteúdo dele pro seu
`.env` (substituindo o que já está lá, ou ajustando só as linhas de banco
de dados e sessão).

O detalhe mais importante: dentro do Docker, o `DB_HOST` **não é**
`127.0.0.1` — é `db`, que é o nome do serviço do banco lá no
`docker-compose.yml`. Os containers se enxergam pelo nome do serviço, não
pelo IP local da sua máquina.

## 3. Confirmar que o `init.sql` está no lugar certo

O `docker-compose.yml` espera encontrar o arquivo em:

```
database/init.sql
```

Se você tinha colocado em outro lugar, move ele pra essa pasta (crie a
pasta `database/` na raiz do projeto se ainda não existir).

## 4. Construir e subir os containers

No terminal, na raiz do projeto (onde está o `docker-compose.yml`), roda:

```
docker compose up --build
```

Esse comando vai:
- Construir a imagem do PHP/Laravel (baixa as dependências com Composer)
- Subir o container do MySQL e já criar o banco com as tabelas e os dados
  do `init.sql` (só na primeira vez — depois disso, os dados ficam salvos)

Deixa esse terminal aberto, ele vai mostrar os logs dos dois containers.
Se preferir rodar em segundo plano (sem ficar ocupando o terminal), usa:

```
docker compose up --build -d
```

## 5. Gerar a chave da aplicação

Com os containers já rodando, abre **outro terminal** e roda:

```
docker compose exec app php artisan key:generate
```

Isso entra no container do PHP e gera a `APP_KEY` no seu `.env`.

## 6. Acessar no navegador

Abre:

```
http://localhost:8000
```

Login de teste:
- **E-mail:** admin@valorant.com
- **Senha:** 123456

(Se a senha não funcionar de primeira pelo mesmo motivo de antes — hash
gerado fora do ambiente — roda esse comando pra recriar a senha direto no
container:)

```
docker compose exec app php artisan tinker
```

E dentro do tinker:

```
User::where('email', 'admin@valorant.com')->update(['password' => bcrypt('123456')]);
```

## Comandos do dia a dia

| O que você quer fazer | Comando |
|---|---|
| Subir os containers | `docker compose up -d` |
| Parar os containers | `docker compose down` |
| Ver os logs em tempo real | `docker compose logs -f` |
| Entrar no terminal do container PHP | `docker compose exec app bash` |
| Rodar um comando artisan qualquer | `docker compose exec app php artisan nome-do-comando` |
| Reconstruir a imagem (depois de mudar o Dockerfile) | `docker compose up --build` |

## Por que os dados do banco não se perdem?

O `docker-compose.yml` usa um **volume** (`valorant_db_data`) pra guardar
os arquivos do MySQL fora do container. Então mesmo que você pare e suba
os containers de novo, os dados continuam lá. O `init.sql` só roda de
verdade na **primeira vez** que o volume é criado — se quiser começar
do zero, apague o volume com:

```
docker compose down -v
```

(O `-v` remove os volumes também, ou seja, o banco volta a ficar vazio e
o `init.sql` roda de novo na próxima subida.)

## Sobre as imagens do projeto

Continua valendo o mesmo esquema de antes: a pasta `public/img/` precisa
ter as imagens (`logo-valorant.png`, `arte-login.jpg`, `fundo-login.jpg`,
`fundo-painel.jpg`, ícones da sidebar, etc). Como o `docker-compose.yml`
sincroniza a sua pasta local com o container (`volumes: - .:/var/www/html`),
basta colocar as imagens na pasta normal do projeto, sem precisar
reconstruir nada.
