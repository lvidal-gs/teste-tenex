# API de Carnê - Tenex

## Requisitos
- PHP: ^7.3|^8.0,
- MySQL: ^5.7
- Composer

## Sobre a aplicação
Essa aplicação se trata de uma API feita para criar novos parcelamentos e visualizar suas parcelas quando desejar. Mas além da API possui também um front simples para facilitação de quem irá testar - basta entrar na raiz da URL fornecida após inicialização.

Para testes, pode ser utilizado tanto o front-end da aplicação - feito na própria _syntax blade_ do Laravel - ou até mesmo as rotas da API com dados enviados via JSON através do Postman.
A aplicação possui alguns tratamentos de erros, nada muito complexo pois não é o foco do processo.

## Iniciando a aplicação
1. Para dar inicio a aplicação será necessário, primeiramente, clonar este repositório em sua máquina local e após a clonagem rodar o `composer install` no seu terminal dentro do diretório clonado. 

2. Após a instalação das dependências, basta rodar o comando `php artisan serve`.

3. Caso ocorra tudo bem, você verá uma mensagem como a abaixo. Pegue a URL que foi apresentada e cole no Postman ou abra no navegador WEB se preferir.

![alt text](/screenshots/terminal.jpg)

4. Crie uma base de dados MySQL com o nome de `desafio_tenex`

5. Com a base criada, em outro terminal rode o comando `php artisan migrate` para criar as tabelas do banco de dados que persistirão os dados.

Pela simplicidade da aplicação e por motivos de facilidade de processo, o arquivo `.env` já foi disponibilzado. Configure-o com as credenciais do seu banco de dados MySQL - abaixo está um exemplo:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=desafio_tenex
    DB_USERNAME=root
    DB_PASSWORD=

Com tudo configurado, basta realizar os testes.

### Rotas de API
A aplicação possui duas rotas de consumo de API:
- `/api/envio-carne`: Rota responsável por fazer a criação do carnê de pagamento. Ela recebe um JSON com algumas key's e a partir dessas keys, a API as trata e salva no banco de dados:

        "valor_total": (float),
        "qtd_parcelas": (integer),
        "data_primero_vencimento": (date - YYYY-MM-DD),
        "periodicidade": (string | mensal/semanal),
        "valor_entrada": (float | opcional),
    
Caso haja um erro na criação, será informado via API

- `/api/get-carne/ID` - ID (integer): Recebe um ID como parâmetro e devolve um JSON com as parcelas geradas. 
Caso haja um erro na consulta, será informado via API.

## Front-End
### Tela inicial
A tela abaixo se trata da tela inicial que já é o form. O form possui alguns tratamentos de erros, feitos via back-end, para evitar resultados inesperados.

Resultados positivos e negativos serão demonstrados na página.

No canto superior direito temos um link que vai para a tela de listagem das parcelas.
![alt text](/screenshots/home.png)

## Listagem
A tela de listagem mostra todas as operações criadas até o momento - inclusive as feitas via API JSON. Ao clicar em "Visualizar", vamos para a visualização dos dados e parcelas daquele registro.

*Não é possível editar/excluir nenhum registro, somente visualizá-los.* 
![alt text](/screenshots/listagem.png)

## Dados de Carnê
Com o registro criado, é possível ver seus dados em uma outra seção que mostra detalhadamente os dados do carnê à esquerda, e à direita temos a parcelas detalhadas.

É importante ressaltarmos que algumas parcelas, quando somadas podem não dar o valor total. Logo a diferença entre a soma das parcelas e valor total - se houver - é acrescida na ÚLTIMA parcela (como na segunda imagem)
![alt text](/screenshots/dados.png)
![alt text](/screenshots/dados2.png)

