<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Paths
     |--------------------------------------------------------------------------
     |
     | Aqui você define os caminhos da API que devem ser afetados pelas regras
     | de CORS. O padrão é permitir qualquer caminho de `api/*`.
     |
     */
    'paths' => ['api/*'],  // Permite o acesso a todas as rotas de API

    /*
     |--------------------------------------------------------------------------
     | Métodos Permitidos
     |--------------------------------------------------------------------------
     |
     | Aqui você pode definir quais métodos HTTP são permitidos. O padrão é
     | permitir todos os métodos.
     |
     */
    'allowed_methods' => ['*'],  // Permite todos os métodos HTTP (GET, POST, etc.)

    /*
     |--------------------------------------------------------------------------
     | Origens Permitidas
     |--------------------------------------------------------------------------
     |
     | Defina quais origens (domínios) podem acessar sua API. O padrão é permitir
     | todas as origens, mas você pode restringir para um ou mais domínios específicos.
     |
     */
    'allowed_origins' => ['*'],  // Permite qualquer origem (alterar para um domínio específico, se necessário)

    /*
     |--------------------------------------------------------------------------
     | Cabeçalhos Permitidos
     |--------------------------------------------------------------------------
     |
     | Aqui você define os cabeçalhos que podem ser enviados nas requisições.
     |
     */
    'allowed_headers' => ['*'],  // Permite todos os cabeçalhos

    /*
     |--------------------------------------------------------------------------
     | Cabeçalhos Expostos
     |--------------------------------------------------------------------------
     |
     | Caso você precise expor alguns cabeçalhos adicionais, defina aqui.
     | Isso pode ser útil quando você deseja acessar certos cabeçalhos de resposta.
     |
     */
    'exposed_headers' => [],

    /*
     |--------------------------------------------------------------------------
     | Tempo Máximo de Cache
     |--------------------------------------------------------------------------
     |
     | Define o tempo em segundos que os resultados de CORS podem ser armazenados
     | em cache pelo navegador.
     |
     */
    'max_age' => 0,  // Sem cache

    /*
     |--------------------------------------------------------------------------
     | Suporte a Credenciais
     |--------------------------------------------------------------------------
     |
     | Se você precisar permitir o envio de credenciais como cookies, tokens de
     | autenticação, entre outros, defina como true.
     |
     */
    'supports_credentials' => true,
];
