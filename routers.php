<?php
global $routers;
$routers = array();

$routers['/inicio']                             = '/Home';
$routers['/quem-somos']                         = '/QuemSomos';
$routers['/produtos-e-servicos']                = '/ProdutosEServicos';
$routers['/sair']                               = '/Login/sair';

$routers['/letreiro-em-lona']                   = '/ProdutosEServicos/letreiroEmLona';
$routers['/letreiro-em-acm']                    = '/ProdutosEServicos/letreiroEmAcm';
$routers['/adesivo']                            = '/ProdutosEServicos/adesivo';
$routers['/banners']                            = '/ProdutosEServicos/banners';
$routers['/envelopamento-de-frotas']            = '/ProdutosEServicos/envelopamentoDeFrotas';
$routers['/envelopamento-de-geladeira']         = '/ProdutosEServicos/envelopamentoDeGeladeira';
$routers['/totens']                             = '/ProdutosEServicos/totens';
$routers['/cartao-de-visita']                   = '/ProdutosEServicos/cartaoDeVisita';
$routers['/panfleto']                           = '/ProdutosEServicos/panfleto';
$routers['/tabua-para-churrasco']               = '/ProdutosEServicos/tabuaParaChurrasco';

$routers['/pedido/alteraPedido']                = '/Pedidos/alteraPedido';
$routers['/pedido/alteraVisualizacaoPedido']    = '/Pedidos/alteraVisualizacaoPedido';

$routers['/pedido/{slug}']                      = '/Pedidos/pedido/:slug';