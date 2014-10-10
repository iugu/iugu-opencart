<?php
$_['heading_title']  = '<a style="color:#00a99d;text-decoration:none;font-weight:bold;" href="http://iugu.com/"><img style="vertical-align: middle;
padding-bottom: 3px;"  alt="Pagamento iugu Boleto" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsSAAALEgHS3X78AAAAB3RJTUUH3goHDhUjrMtNiwAAAThJREFUSMfF1jFLAzEUwPE/9WqlJw4Vi1VUdHBycBTEb9BdUERBFCc3cS50aTc/ibSTfgihOp5OLkLRwaFFXOoS4fHI8OSSM5Ah78j9ksvjXaCgNuWJrQD7wDvwGQueBSai12NBywqaAI1YWN+DXQM1IAWqQDkU9uzBdB8Ch0CSF7szYL/9OC/WAN6M2G2obFwENoBt4NKlv8ZOYiXOrgdLisJOrRNngC836UGtsAU8AgOgI+JDAY2sUKpWuCmePYl4JuJnak5Fv7Tkgb7VuGlY3L0aT1t39SFWJwtr1+0kA25UcR6IOakVOlCfYi9WJiWetN2JhR15sFcXXwOW3G+kGgLrGcvPCzCfFzv/Q3HthTizC2BswLJQZ1dxRXYOWADaHqxf5BVgNRZWV1At5vVtHbgCtviv9gOawJcGUybBdgAAAABJRU5ErkJggg==" /> iugu Boleto</a>';
$_['heading_title_main']       = 'iugu Boleto';
$_['heading_title_modulo']       = '<a style="color:#00a99d;text-decoration:none;font-weight:bold;" href="http://iugu.com/">iugu Boleto</a>';

$_['text_feito']         = '<a style="text-decoration:none" href="http://www.codemarket.com.br"><b  style="color:#00a99d;margin-right: 8px;">Feito por Felipo Antonoff Araújo - contato@codemarket.com.br</a><br>
Financiado pela <a href="http://iugu.com/">iugu</a>';
$_['text_payment']        			= 'Formas de Pagamento';
$_['text_success']        			= 'Módulo iugu Boleto atualizado com sucesso!';
$_['text_iugu_bankslip'] 				= '<a onclick="window.open(\'http://www.iugu.com.br/\');"><img src="view/image/payment/iugu.png" alt="iugu" title="iugu" style="border: 1px solid #EEEEEE;" /></a>';
$_['text_order_nao_efetivado'] 		= 'O pagamento no site da iugu não foi concluído.';
$_['text_info_token'] 		= "<b>Como configurar o Token:</b> <br> <img scr ='image/iugu/token_iugu.gif'>
<img src='image/iugu/token_iugu.gif' alt='Configurando o Token' height='535' width='1024'>
<p><b>Passos: </b></p>
1) Entre no seu Painel da iugu  <br>
2) Clique em Administração -> Configurações da Conta <br>
3) Em Adicionar API Token, escolha o tipo de Token Test = Teste e Live = Produção <br>
4) Coloque uma descrição para o Token e Clique em Criar <br>
5) Copie o Token Gerado e coloque no Campo Token abaixo <br>
Obs: Use o Token de teste apenas para testar<br><br>";

$_['entry_token']         				= 'Token:<br /><span class="help">Token de Segurança da iugu</span>';
$_['entry_order_aguardando_pagamento'] 	= 'Status Aguardando pagamento:<br /><span class="help">O comprador iniciou o Pagamento.</span>';
$_['entry_order_analise'] 				= 'Status Em análise:<br /><span class="help">O Pagamento está em análise.</span>';
$_['entry_order_paga'] 					= 'Status Pago:<br /><span class="help">O Pedido foi pago pelo comprador e a iugu já recebeu uma confirmação da instituição financeira.</span>';
$_['entry_order_expirado'] 			= 'Status Expirado:<br /><span class="help">O Pagamento foi expirado.</span>';
$_['entry_order_reembolsado'] 			= 'Status Reembolsado:<br /><span class="help">O Pagamento foi devolvido ao Cliente</span>';
$_['entry_order_cancelada'] 			= 'Status Cancelado:<br /><span class="help">O Pagamento foi cancelado sem ter sido finalizado.</span>';
$_['entry_geo_zone']      			= 'Região geográfica:';
$_['entry_status']        			= 'Situação:';
$_['entry_sort_order']    			= 'Ordenação:';
$_['entry_vencimento']        			= 'Prazo de Vencimento (dias) do Boleto:';
$_['entry_cobranca']        			= 'Enviar E-mail de Cobrança:';
$_['entry_titulo']        			= 'Título que aparece na Escolha do Pagamento e Pedido:';
$_['entry_confirmar']        			= 'Texto do Botão Confirmar:';
$_['entry_informativo']        			= 'Texto informativo sobre o Pagamento (aparece no Confirmar):';
$_['entry_update_status_alert'] 	= 'Alertar sobre mudança no status do Pedido:<br /><span class="help">Envia e-mail para o cliente avisando-o sobre mudança no status do Pedido.</span>';

$_['error_permission']    		= 'Atenção: Você não possui permissão para modificar o iugu Boleto!';
$_['error_token']         		= 'Digite o token de segurança';
