<p align="center">
  <img src="https://markt.club/images/logo_marktclub.png" width="200" alt="Logo Markt Club">
</p>

## Desafio Back-End

**Proposta:** O principal objetivo deste desafio é testar o seu conhecimento em Desenvolvimento Back-end seguindo as boas práticas do desenvolvimento moderno.

Você está livre para fazer qualquer alteração no projeto inicial.

## Funcionalidades - O que foi feito?

- Funcionalidades CRUD:
  - Adicionar Usuário
  - Editar Usuário existente
  - Deletar Usuário
  - Listagem de usuários


## Tecnologias utilizadas

Caso você tenha interesse em se aproximar da nossa Stack, usamos:

- PHP 8.1
- GIT
- Docker
- MySqli para interface com o banco de dados

## Como subir o sistema?

1. Faça um clone do repositório
2. Se necessário, alterar portas no arquivo docker-compose.yml em caso de portas conflitantes
3. Executar o comando docker-compose up -d --build para subir os containers

## Minhas Dificuldades
- Utilização do PHP direto no HTML foi novidade e um desafio pra mim, nunca havia trabalhado dessa forma.
- Configuração do Docker para habilitar extensão do MySqli (minha solução foi criar um Dockerfile para fazer essa adaptação)
- Manipulação e compreensão de branchs no GIT
- Apresentação de dados do usuário no formulário de edição

## Possíveis features futuras
- Fluxo de login
- Encriptação de senha
- Formatação de dados na listagem (ex.: CPF)
- Detalhamento de dados do usuário (modal)
- Paginação de listagem
