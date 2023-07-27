# projeto de calculo de planos de saúde
## Front-End:

O Front-End não precisa ser modificado em nada, exeto se quiser conectar o backend localmente. Então, faz-se necessário mudar a chamada da api para a url local em `public/js/index.js`
Atualmente ele está apontando para a url do servidor da plataforma de desenvolvimento repl.it. O repl.it é um serviço de IDE online com capacidade de hospedar ou tornar acessível os 
projetos por meio do link. Saiba mais sobre o repl.it: [Replit: plataforma de desenvolvimento online](https://replit.com/site/about)

## Back-End:

O Back-End foi desenvolvido em PHP. Por não ser possível hospedar um código PHP no GitHub pages, foi preciso hospeda-lo no repl.it. 
Link do backend no Repl.it: [Projeto Backend](https://replit.com/@FernandoLucas8/project#src/model/PlansAndPrices.php)
Para rodar o projeto Back-End localmente, existe a possibilidade de usar o Xampp ou WampServer. Basta adicionar o projeto no diretório correto do serviço que pretende usar:
Doc Xampp: [Doc do Xampp](https://www.apachefriends.org/pt_br/hosting.html)
Doc Wamp Server: [Doc do Wamp](https://www.wampserver.com/en/)

Caso esteja rodando o backend localmente, não esqueça de mudar a chamada da api no front. 
