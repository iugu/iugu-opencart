# IUGU - Módulo OpenCart p/ Boletos

## Instalação

Módulo Desenvolvido por Felipo Antonoff Araújo - http://www.codemarket.com.br

Passo 1) Envie para a raiz da sua Loja as Pastas:
admin, catalog, imagem, system e vqmod

Passo 2) Se preciso de permissões nas pastas enviadas, se a hospedagem estiver configurada corretamente não vai ser preciso

Passo 3) Entre no Administrador da loja e vai Sistema -> Usuários -> Grupos de Usuários
Clique em Editar no seu Grupo de usuário, normalmente o Administrador e de permissão de Acesso e Modificação para o  payment/iugu_bankslip
Pode clicar em Marcar tudo para dar permissão geral e depois clique em Salvar
O Passo 3 as vezes não é preciso.

Passo 4) Ainda dentro do Administrador da Loja, vai em Extensões -> Formas de Pagamento e Procura por iugu Boleto, depois na linha dele clique em Instalar

Passo 5) Clique agora em Editar, pronto configure o Módulo com o Token da iugu e as outras opções

## Teste

Faça uma simulação de compra na Loja e veja se aparece o Pagamento Boleto iugu, lembrando que pode editar o nome dele no painel do Módulo e depois
prossiga com a compra.
Pode usar o Token de teste geradi na iugu, se quiser apenas simular uma compra

## Retorno do Status

O retorno é automático, o Módulo já informa a iugu a URL de retorno, lembre-se também de instalar o vQmod 2.3 ou mais recente
http://www.codemarket.com.br/opencart/modulos-gerais/vqmod-ferramenta-essencial
Ele é gratuita e importante para o uso de diversos módulos, pois altera arquivos sem mexer direto neles, sendo mais fácil de manutenção por isso

No caso do iugu Boleto é preciso do vqmod, pois acompanha um xml de URL Amigável por completo, ele coloca URL Amigável geral na loja, pois por padrão
o Opencart só coloca em alguns locais, é preciso desse xml ativo, pois a URL de notificação da iugu só pega se for amigável

Por tanto para o Retorno, faça mais um passo, ative a URL Amigável da Loja e verifique se o endereço:
sualoja.com.br/iugu-boleto-notificar aparece uma tela branca, se aparecer está certo

Caso já tenham algum módulo de URL Amigável geral, desativem ele ou o Felipo-SEO-URL.xml, caso contrário pode causar conflito entre eles
Caso desativem o Felipo-SEO-URL.xml, lembre-se de configurar no outro Módulo a seguinte URL:
'payment/iugu_bankslip/callback' => 'iugu-boleto-notificar',

## Licença

A licença do Módulo é a GPL 3, por tanto é um módulo gratuito e pode ser utilizado em diversas lojas, mas sem fim lucrativo, qualquer produto derivado dele, deve
ser também GPL 3 e por isso gratuito, não cobre dos seus clientes por ele, mas sim pelos seus serviços de instalação, configuração e teste
Para mais detalhes sobre ela, acesse - http://www.gnu.org/licenses/

Caso queira suporte pago para esse Módulo ou outros Módulos para Opencart, acesse - http://www.codemarket.com.br
