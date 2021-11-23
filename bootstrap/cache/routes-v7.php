<?php

/*
|--------------------------------------------------------------------------
| Load The Cached Routes
|--------------------------------------------------------------------------
|
| Here we will decode and unserialize the RouteCollection instance that
| holds all of the route information for an application. This allows
| us to instantaneously load the entire route map into the router.
|
*/

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/_debugbar/open' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.openhandler',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_debugbar/assets/stylesheets' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.assets.css',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_debugbar/assets/javascript' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.assets.js',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/wink/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'wink.auth.login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'wink.auth.attempt',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/wink/password/forgot' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'wink.password.forgot',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'wink.password.email',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/wink/api/posts' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'wink.posts.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/wink/api/tags' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'wink.tags.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/wink/api/team' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'wink.team.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/wink/api/uploads' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'wink.images.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/wink/api/pages' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'wink.pages.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/wink/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'wink.logout',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/affiliate/order' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rest.affiliate.order',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/_debugbar/c(?|lockwork/([^/]++)(*:39)|ache/([^/]++)(?:/([^/]++))?(*:73))|/wink(?|/(?|password/reset/([^/]++)(*:116)|api/(?|p(?|osts(?|(?:/([^/]++))?(*:156)|/([^/]++)(?|(*:176)))|ages(?|(?:/([^/]++))?(*:207)|/([^/]++)(?|(*:227))))|t(?|ags(?|(?:/([^/]++))?(*:262)|/([^/]++)(?|(*:282)))|eam(?|(?:/([^/]++))?(*:312)|/([^/]++)(?|(*:332))))))|(?:/((?:.*)))?(*:359))|/([^/]++)?(*:378)|/([^/]++)/(?|guide(?|(*:407)|/affiliate/setup(*:431))|privacy\\.html(*:453)|termsofservice\\.html(*:481)|connect(?|(*:499))|fast/connect(*:520)|o(?|auth/callback(*:545)|rder_status\\.js(*:568))|s(?|ign(?|up/([^/]++)(*:598)|in(*:608))|ubscription(?|(*:631)|/(?|billing/([^/]++)(?|(*:662)|/confirmation(*:683))|cancel(*:698))))|a(?|uth/(?|sign(?|up/([^/]++)(*:738)|in(*:748))|token(*:762)|password(*:778))|ffiliate(?|(*:798)|/(?|([^/]++)(?|(*:821)|/signup(*:836))|analytics(*:854)))|dmin(?|(*:871)|/(?|s(?|tores(?|(*:895)|/([^/]++)/(?|enable(*:922)|disable(*:937)|view(*:949)))|ettings(?|(*:969)))|accounts(?|(*:990)|/([^/]++)/(?|ban(*:1014)|password/reset(*:1037)))|logs(*:1052))))|reset(?|(*:1072)|/([^/]++)(*:1090))|logout(*:1106)|dashboard(?|(*:1127)|/(?|customize(?|(*:1152)|/integrations(?|(*:1177)|/mails/purchase(*:1201)))|p(?|ayouts(?|(*:1225)|/([^/]++)(*:1243))|review/checkout(*:1268)|lan(?|(*:1283)|/(?|upgrade(*:1303)|cancel(*:1318))))|ac(?|count(?|(*:1343))|tivity(?|(*:1362)|/(?|read(*:1379)|([^/]++)(*:1396))))|settings(?|(*:1419))|help(*:1433)))|webhooks/(?|customers/(?|data_request(*:1481)|redact(*:1496))|shop/redact(*:1517))|blog(*:1531)))/?$}sDu',
    ),
    3 => 
    array (
      39 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.clockwork',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      73 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.cache.delete',
            'tags' => NULL,
          ),
          1 => 
          array (
            0 => 'key',
            1 => 'tags',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      116 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'wink.password.reset',
          ),
          1 => 
          array (
            0 => 'token',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      156 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'wink.posts.show',
            'id' => NULL,
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      176 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'wink.posts.store',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'wink.posts.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      207 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'wink.pages.show',
            'id' => NULL,
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      227 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'wink.pages.store',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'wink.pages.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      262 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'wink.tags.show',
            'id' => NULL,
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      282 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'wink.tags.store',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'wink.tags.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      312 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'wink.team.show',
            'id' => NULL,
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      332 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'wink.team.store',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'wink.team.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      359 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'wink.spa',
            'view' => NULL,
          ),
          1 => 
          array (
            0 => 'view',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      378 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'landing',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      407 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'guide',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
            'POST' => 2,
            'PUT' => 3,
            'PATCH' => 4,
            'DELETE' => 5,
            'OPTIONS' => 6,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      431 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'guide.affiliate.setup',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
            'POST' => 2,
            'PUT' => 3,
            'PATCH' => 4,
            'DELETE' => 5,
            'OPTIONS' => 6,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      453 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'privacy',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      481 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'termsofservice',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
            'POST' => 2,
            'PUT' => 3,
            'PATCH' => 4,
            'DELETE' => 5,
            'OPTIONS' => 6,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      499 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'connect',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'oauth.connect',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      520 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'fast.connect',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      545 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'oauth.callback',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      568 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::vlIyMuW1gAlflGSj',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      598 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'signup',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
            1 => 'store',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      608 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'signin',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      631 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'subscription.select.pack',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      662 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'subscription.pack.billing',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
            1 => 'pack',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      683 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'subscription.billing.confirmation',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
            1 => 'pack',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      698 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'subscription.cancel',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      738 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'auth.signup',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
            1 => 'store',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      748 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'auth.signin',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      762 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'auth.reset.token',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      778 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'auth.reset.password',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      798 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'affiliate.home',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
            'POST' => 2,
            'PUT' => 3,
            'PATCH' => 4,
            'DELETE' => 5,
            'OPTIONS' => 6,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      821 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'affiliate.signup',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
            1 => 'store',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      836 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'affiliate.form.signup',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
            1 => 'store',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      854 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'affiliate.analytics',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      871 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      895 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.stores',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      922 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.stores.enable',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
            1 => 'store',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      937 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.stores.disable',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
            1 => 'store',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      949 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.stores.view',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
            1 => 'store',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      969 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.settings',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.settings.update',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      990 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1014 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users.ban',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
            1 => 'user',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1037 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users.password.reset',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
            1 => 'user',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1052 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.logs',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1072 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reset',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1090 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
            1 => 'token',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1106 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'signout',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1127 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.home',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.form.home',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1152 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.customize',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.customize.save',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1177 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.customize.integrations',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.customize.integrations.save',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1201 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.customize.integrations.mails.purchase',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1225 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.payouts',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1243 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.payouts.send',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
            1 => 'commission',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1268 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.preview.checkout',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1283 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.plan',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1303 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.plan.upgrade',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1318 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.plan.cancel',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1343 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.account',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.account.save',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1362 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.activity',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1379 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.activity.read.all',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1396 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.activity.read',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
            1 => 'notification',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1419 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.settings',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.settings.save',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1433 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.help',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1481 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webhooks.customer.show',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1496 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webhooks.customer.delete',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1517 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webhooks.store.delete',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1531 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blog.index',
            'locale' => NULL,
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'debugbar.openhandler' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_debugbar/open',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\OpenHandlerController@handle',
        'as' => 'debugbar.openhandler',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\OpenHandlerController@handle',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debugbar.clockwork' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_debugbar/clockwork/{id}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\OpenHandlerController@clockwork',
        'as' => 'debugbar.clockwork',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\OpenHandlerController@clockwork',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debugbar.assets.css' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_debugbar/assets/stylesheets',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\AssetController@css',
        'as' => 'debugbar.assets.css',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\AssetController@css',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debugbar.assets.js' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_debugbar/assets/javascript',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\AssetController@js',
        'as' => 'debugbar.assets.js',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\AssetController@js',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debugbar.cache.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => '_debugbar/cache/{key}/{tags?}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\CacheController@delete',
        'as' => 'debugbar.cache.delete',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\CacheController@delete',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'wink.auth.login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'wink/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'domain' => NULL,
        'uses' => 'Wink\\Http\\Controllers\\LoginController@showLoginForm',
        'controller' => 'Wink\\Http\\Controllers\\LoginController@showLoginForm',
        'as' => 'wink.auth.login',
        'namespace' => NULL,
        'prefix' => 'wink',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'wink.auth.attempt' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'wink/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'domain' => NULL,
        'uses' => 'Wink\\Http\\Controllers\\LoginController@login',
        'controller' => 'Wink\\Http\\Controllers\\LoginController@login',
        'as' => 'wink.auth.attempt',
        'namespace' => NULL,
        'prefix' => 'wink',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'wink.password.forgot' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'wink/password/forgot',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'domain' => NULL,
        'uses' => 'Wink\\Http\\Controllers\\ForgotPasswordController@showResetRequestForm',
        'controller' => 'Wink\\Http\\Controllers\\ForgotPasswordController@showResetRequestForm',
        'as' => 'wink.password.forgot',
        'namespace' => NULL,
        'prefix' => 'wink',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'wink.password.email' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'wink/password/forgot',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'domain' => NULL,
        'uses' => 'Wink\\Http\\Controllers\\ForgotPasswordController@sendResetLinkEmail',
        'controller' => 'Wink\\Http\\Controllers\\ForgotPasswordController@sendResetLinkEmail',
        'as' => 'wink.password.email',
        'namespace' => NULL,
        'prefix' => 'wink',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'wink.password.reset' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'wink/password/reset/{token}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'domain' => NULL,
        'uses' => 'Wink\\Http\\Controllers\\ForgotPasswordController@showNewPassword',
        'controller' => 'Wink\\Http\\Controllers\\ForgotPasswordController@showNewPassword',
        'as' => 'wink.password.reset',
        'namespace' => NULL,
        'prefix' => 'wink',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'wink.posts.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'wink/api/posts',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'Wink\\Http\\Middleware\\Authenticate',
        ),
        'domain' => NULL,
        'uses' => 'Wink\\Http\\Controllers\\PostsController@index',
        'controller' => 'Wink\\Http\\Controllers\\PostsController@index',
        'as' => 'wink.posts.index',
        'namespace' => NULL,
        'prefix' => 'wink',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'wink.posts.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'wink/api/posts/{id?}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'Wink\\Http\\Middleware\\Authenticate',
        ),
        'domain' => NULL,
        'uses' => 'Wink\\Http\\Controllers\\PostsController@show',
        'controller' => 'Wink\\Http\\Controllers\\PostsController@show',
        'as' => 'wink.posts.show',
        'namespace' => NULL,
        'prefix' => 'wink',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'wink.posts.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'wink/api/posts/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'Wink\\Http\\Middleware\\Authenticate',
        ),
        'domain' => NULL,
        'uses' => 'Wink\\Http\\Controllers\\PostsController@store',
        'controller' => 'Wink\\Http\\Controllers\\PostsController@store',
        'as' => 'wink.posts.store',
        'namespace' => NULL,
        'prefix' => 'wink',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'wink.posts.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'wink/api/posts/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'Wink\\Http\\Middleware\\Authenticate',
        ),
        'domain' => NULL,
        'uses' => 'Wink\\Http\\Controllers\\PostsController@delete',
        'controller' => 'Wink\\Http\\Controllers\\PostsController@delete',
        'as' => 'wink.posts.delete',
        'namespace' => NULL,
        'prefix' => 'wink',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'wink.tags.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'wink/api/tags',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'Wink\\Http\\Middleware\\Authenticate',
        ),
        'domain' => NULL,
        'uses' => 'Wink\\Http\\Controllers\\TagsController@index',
        'controller' => 'Wink\\Http\\Controllers\\TagsController@index',
        'as' => 'wink.tags.index',
        'namespace' => NULL,
        'prefix' => 'wink',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'wink.tags.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'wink/api/tags/{id?}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'Wink\\Http\\Middleware\\Authenticate',
        ),
        'domain' => NULL,
        'uses' => 'Wink\\Http\\Controllers\\TagsController@show',
        'controller' => 'Wink\\Http\\Controllers\\TagsController@show',
        'as' => 'wink.tags.show',
        'namespace' => NULL,
        'prefix' => 'wink',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'wink.tags.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'wink/api/tags/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'Wink\\Http\\Middleware\\Authenticate',
        ),
        'domain' => NULL,
        'uses' => 'Wink\\Http\\Controllers\\TagsController@store',
        'controller' => 'Wink\\Http\\Controllers\\TagsController@store',
        'as' => 'wink.tags.store',
        'namespace' => NULL,
        'prefix' => 'wink',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'wink.tags.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'wink/api/tags/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'Wink\\Http\\Middleware\\Authenticate',
        ),
        'domain' => NULL,
        'uses' => 'Wink\\Http\\Controllers\\TagsController@delete',
        'controller' => 'Wink\\Http\\Controllers\\TagsController@delete',
        'as' => 'wink.tags.delete',
        'namespace' => NULL,
        'prefix' => 'wink',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'wink.team.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'wink/api/team',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'Wink\\Http\\Middleware\\Authenticate',
        ),
        'domain' => NULL,
        'uses' => 'Wink\\Http\\Controllers\\TeamController@index',
        'controller' => 'Wink\\Http\\Controllers\\TeamController@index',
        'as' => 'wink.team.index',
        'namespace' => NULL,
        'prefix' => 'wink',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'wink.team.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'wink/api/team/{id?}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'Wink\\Http\\Middleware\\Authenticate',
        ),
        'domain' => NULL,
        'uses' => 'Wink\\Http\\Controllers\\TeamController@show',
        'controller' => 'Wink\\Http\\Controllers\\TeamController@show',
        'as' => 'wink.team.show',
        'namespace' => NULL,
        'prefix' => 'wink',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'wink.team.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'wink/api/team/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'Wink\\Http\\Middleware\\Authenticate',
        ),
        'domain' => NULL,
        'uses' => 'Wink\\Http\\Controllers\\TeamController@store',
        'controller' => 'Wink\\Http\\Controllers\\TeamController@store',
        'as' => 'wink.team.store',
        'namespace' => NULL,
        'prefix' => 'wink',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'wink.team.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'wink/api/team/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'Wink\\Http\\Middleware\\Authenticate',
        ),
        'domain' => NULL,
        'uses' => 'Wink\\Http\\Controllers\\TeamController@delete',
        'controller' => 'Wink\\Http\\Controllers\\TeamController@delete',
        'as' => 'wink.team.delete',
        'namespace' => NULL,
        'prefix' => 'wink',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'wink.images.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'wink/api/uploads',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'Wink\\Http\\Middleware\\Authenticate',
        ),
        'domain' => NULL,
        'uses' => 'Wink\\Http\\Controllers\\ImageUploadsController@upload',
        'controller' => 'Wink\\Http\\Controllers\\ImageUploadsController@upload',
        'as' => 'wink.images.store',
        'namespace' => NULL,
        'prefix' => 'wink',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'wink.pages.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'wink/api/pages',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'Wink\\Http\\Middleware\\Authenticate',
        ),
        'domain' => NULL,
        'uses' => 'Wink\\Http\\Controllers\\PagesController@index',
        'controller' => 'Wink\\Http\\Controllers\\PagesController@index',
        'as' => 'wink.pages.index',
        'namespace' => NULL,
        'prefix' => 'wink',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'wink.pages.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'wink/api/pages/{id?}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'Wink\\Http\\Middleware\\Authenticate',
        ),
        'domain' => NULL,
        'uses' => 'Wink\\Http\\Controllers\\PagesController@show',
        'controller' => 'Wink\\Http\\Controllers\\PagesController@show',
        'as' => 'wink.pages.show',
        'namespace' => NULL,
        'prefix' => 'wink',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'wink.pages.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'wink/api/pages/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'Wink\\Http\\Middleware\\Authenticate',
        ),
        'domain' => NULL,
        'uses' => 'Wink\\Http\\Controllers\\PagesController@store',
        'controller' => 'Wink\\Http\\Controllers\\PagesController@store',
        'as' => 'wink.pages.store',
        'namespace' => NULL,
        'prefix' => 'wink',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'wink.pages.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'wink/api/pages/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'Wink\\Http\\Middleware\\Authenticate',
        ),
        'domain' => NULL,
        'uses' => 'Wink\\Http\\Controllers\\PagesController@delete',
        'controller' => 'Wink\\Http\\Controllers\\PagesController@delete',
        'as' => 'wink.pages.delete',
        'namespace' => NULL,
        'prefix' => 'wink',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'wink.logout' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'wink/logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'Wink\\Http\\Middleware\\Authenticate',
        ),
        'domain' => NULL,
        'uses' => 'Wink\\Http\\Controllers\\LoginController@logout',
        'controller' => 'Wink\\Http\\Controllers\\LoginController@logout',
        'as' => 'wink.logout',
        'namespace' => NULL,
        'prefix' => 'wink',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'wink.spa' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'wink/{view?}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'Wink\\Http\\Middleware\\Authenticate',
        ),
        'domain' => NULL,
        'uses' => 'Wink\\Http\\Controllers\\SPAViewController@__invoke',
        'controller' => 'Wink\\Http\\Controllers\\SPAViewController',
        'as' => 'wink.spa',
        'namespace' => NULL,
        'prefix' => 'wink',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'view' => '(.*)',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'rest.affiliate.order' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/affiliate/order',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'cors',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Affiliate\\NewOrderController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Affiliate\\NewOrderController',
        'as' => 'rest.affiliate.order',
        'namespace' => NULL,
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'landing' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'signin.with.app',
          2 => 'plan.remember',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\LandingPageController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\LandingPageController',
        'namespace' => NULL,
        'prefix' => '{locale?}',
        'where' => 
        array (
        ),
        'as' => 'landing',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'guide' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
        2 => 'POST',
        3 => 'PUT',
        4 => 'PATCH',
        5 => 'DELETE',
        6 => 'OPTIONS',
      ),
      'uri' => '{locale?}/guide',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\RedirectController@__invoke',
        'controller' => '\\Illuminate\\Routing\\RedirectController',
        'namespace' => NULL,
        'prefix' => '{locale?}',
        'where' => 
        array (
        ),
        'as' => 'guide',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'destination' => '/',
        'status' => 301,
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'guide.affiliate.setup' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
        2 => 'POST',
        3 => 'PUT',
        4 => 'PATCH',
        5 => 'DELETE',
        6 => 'OPTIONS',
      ),
      'uri' => '{locale?}/guide/affiliate/setup',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\RedirectController@__invoke',
        'controller' => '\\Illuminate\\Routing\\RedirectController',
        'namespace' => NULL,
        'prefix' => '{locale?}',
        'where' => 
        array (
        ),
        'as' => 'guide.affiliate.setup',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'destination' => '/',
        'status' => 301,
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'privacy' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/privacy.html',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\LandingPageController@privacy',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\LandingPageController@privacy',
        'namespace' => NULL,
        'prefix' => '{locale?}',
        'where' => 
        array (
        ),
        'as' => 'privacy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'termsofservice' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
        2 => 'POST',
        3 => 'PUT',
        4 => 'PATCH',
        5 => 'DELETE',
        6 => 'OPTIONS',
      ),
      'uri' => '{locale?}/termsofservice.html',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\RedirectController@__invoke',
        'controller' => '\\Illuminate\\Routing\\RedirectController',
        'namespace' => NULL,
        'prefix' => '{locale?}',
        'where' => 
        array (
        ),
        'as' => 'termsofservice',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'destination' => '/',
        'status' => 301,
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'connect' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/connect',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
          2 => 'plan.remember',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Auth\\ConnectController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Auth\\ConnectController',
        'namespace' => NULL,
        'prefix' => '{locale?}',
        'where' => 
        array (
        ),
        'as' => 'connect',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'fast.connect' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/fast/connect',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
          2 => 'plan.remember',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\OAuth\\OAuthController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\OAuth\\OAuthController',
        'namespace' => NULL,
        'prefix' => '{locale?}',
        'where' => 
        array (
        ),
        'as' => 'fast.connect',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'oauth.connect' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '{locale?}/connect',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
          2 => 'plan.remember',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\OAuth\\OAuthController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\OAuth\\OAuthController',
        'namespace' => NULL,
        'prefix' => '{locale?}',
        'where' => 
        array (
        ),
        'as' => 'oauth.connect',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'oauth.callback' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/oauth/callback',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
          2 => 'plan.remember',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\OAuth\\OAuthCallbackController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\OAuth\\OAuthCallbackController',
        'namespace' => NULL,
        'prefix' => '{locale?}',
        'where' => 
        array (
        ),
        'as' => 'oauth.callback',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'signup' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/signup/{store}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
          2 => 'plan.remember',
          3 => 'has.store',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Auth\\SignUpController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Auth\\SignUpController',
        'namespace' => NULL,
        'prefix' => '{locale?}',
        'where' => 
        array (
        ),
        'as' => 'signup',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'auth.signup' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '{locale?}/auth/signup/{store}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
          2 => 'plan.remember',
          3 => 'has.store',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Auth\\CreateUserController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Auth\\CreateUserController',
        'namespace' => NULL,
        'prefix' => '{locale?}',
        'where' => 
        array (
        ),
        'as' => 'auth.signup',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'signin' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/signin',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
          2 => 'plan.remember',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Auth\\SignInController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Auth\\SignInController',
        'namespace' => NULL,
        'prefix' => '{locale?}',
        'where' => 
        array (
        ),
        'as' => 'signin',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'auth.signin' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '{locale?}/auth/signin',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
          2 => 'plan.remember',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Auth\\AuthenticateController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Auth\\AuthenticateController',
        'namespace' => NULL,
        'prefix' => '{locale?}',
        'where' => 
        array (
        ),
        'as' => 'auth.signin',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'reset' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/reset',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
          2 => 'plan.remember',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Auth\\ResetPassword\\IndexController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Auth\\ResetPassword\\IndexController',
        'namespace' => NULL,
        'prefix' => '{locale?}',
        'where' => 
        array (
        ),
        'as' => 'reset',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'auth.reset.token' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '{locale?}/auth/token',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
          2 => 'plan.remember',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Auth\\ResetPassword\\SendResetTokenController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Auth\\ResetPassword\\SendResetTokenController',
        'namespace' => NULL,
        'prefix' => '{locale?}',
        'where' => 
        array (
        ),
        'as' => 'auth.reset.token',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/reset/{token}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
          2 => 'plan.remember',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Auth\\ResetPassword\\EditController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Auth\\ResetPassword\\EditController',
        'namespace' => NULL,
        'prefix' => '{locale?}',
        'where' => 
        array (
        ),
        'as' => 'password',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'auth.reset.password' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '{locale?}/auth/password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
          2 => 'plan.remember',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Auth\\ResetPassword\\ResetPasswordController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Auth\\ResetPassword\\ResetPasswordController',
        'namespace' => NULL,
        'prefix' => '{locale?}',
        'where' => 
        array (
        ),
        'as' => 'auth.reset.password',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'signout' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Auth\\SignOutController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Auth\\SignOutController',
        'namespace' => NULL,
        'prefix' => '{locale?}',
        'where' => 
        array (
        ),
        'as' => 'signout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'affiliate.home' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
        2 => 'POST',
        3 => 'PUT',
        4 => 'PATCH',
        5 => 'DELETE',
        6 => 'OPTIONS',
      ),
      'uri' => '{locale?}/affiliate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\RedirectController@__invoke',
        'controller' => '\\Illuminate\\Routing\\RedirectController',
        'as' => 'affiliate.home',
        'namespace' => NULL,
        'prefix' => '{locale?}/affiliate',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'destination' => '/',
        'status' => 301,
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'affiliate.signup' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/affiliate/{store}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Affiliate\\Inscription\\SignUpController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Affiliate\\Inscription\\SignUpController',
        'as' => 'affiliate.signup',
        'namespace' => NULL,
        'prefix' => '{locale?}/affiliate',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'affiliate.form.signup' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '{locale?}/affiliate/{store}/signup',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Affiliate\\Inscription\\CreateAccountController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Affiliate\\Inscription\\CreateAccountController',
        'as' => 'affiliate.form.signup',
        'namespace' => NULL,
        'prefix' => '{locale?}/affiliate',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'affiliate.analytics' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/affiliate/analytics',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'is.affiliate',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Affiliate\\Dashboard\\AnalyticsController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Affiliate\\Dashboard\\AnalyticsController',
        'as' => 'affiliate.analytics',
        'namespace' => NULL,
        'prefix' => '{locale?}/affiliate',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::vlIyMuW1gAlflGSj' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/order_status.js',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'cors',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\OrderStatusScriptController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\OrderStatusScriptController',
        'namespace' => NULL,
        'prefix' => '{locale?}',
        'where' => 
        array (
        ),
        'as' => 'generated::vlIyMuW1gAlflGSj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'subscription.select.pack' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/subscription',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'has.subscription',
          3 => 'store-owner',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Auth\\Subscription\\SubscriptionController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Auth\\Subscription\\SubscriptionController',
        'as' => 'subscription.select.pack',
        'namespace' => NULL,
        'prefix' => '{locale?}/subscription',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'subscription.pack.billing' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/subscription/billing/{pack}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'has.subscription',
          3 => 'store-owner',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Auth\\Subscription\\BillingPaymentController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Auth\\Subscription\\BillingPaymentController',
        'as' => 'subscription.pack.billing',
        'namespace' => NULL,
        'prefix' => '{locale?}/subscription',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'subscription.billing.confirmation' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/subscription/billing/{pack}/confirmation',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'has.subscription',
          3 => 'store-owner',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Auth\\Subscription\\BillingConfirmationController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Auth\\Subscription\\BillingConfirmationController',
        'as' => 'subscription.billing.confirmation',
        'namespace' => NULL,
        'prefix' => '{locale?}/subscription',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'subscription.cancel' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/subscription/cancel',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'has.subscription',
          3 => 'store-owner',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Auth\\Subscription\\CancelController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Auth\\Subscription\\CancelController',
        'as' => 'subscription.cancel',
        'namespace' => NULL,
        'prefix' => '{locale?}/subscription',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.home' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'has.subscription',
          3 => 'store-owner',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\IndexController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\IndexController',
        'as' => 'dashboard.home',
        'namespace' => NULL,
        'prefix' => '{locale?}/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.form.home' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '{locale?}/dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'has.subscription',
          3 => 'store-owner',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\IndexController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\IndexController',
        'as' => 'dashboard.form.home',
        'namespace' => NULL,
        'prefix' => '{locale?}/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.customize' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/dashboard/customize',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'has.subscription',
          3 => 'store-owner',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Customize\\CustomizeController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Customize\\CustomizeController',
        'as' => 'dashboard.customize',
        'namespace' => NULL,
        'prefix' => '{locale?}/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.customize.save' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '{locale?}/dashboard/customize',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'has.subscription',
          3 => 'store-owner',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Customize\\SaveCustomizeSettingController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Customize\\SaveCustomizeSettingController',
        'as' => 'dashboard.customize.save',
        'namespace' => NULL,
        'prefix' => '{locale?}/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.customize.integrations' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/dashboard/customize/integrations',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'has.subscription',
          3 => 'store-owner',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Customize\\IntegrationsController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Customize\\IntegrationsController',
        'as' => 'dashboard.customize.integrations',
        'namespace' => NULL,
        'prefix' => '{locale?}/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.customize.integrations.save' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '{locale?}/dashboard/customize/integrations',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'has.subscription',
          3 => 'store-owner',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Customize\\UpdateIntegrationsController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Customize\\UpdateIntegrationsController',
        'as' => 'dashboard.customize.integrations.save',
        'namespace' => NULL,
        'prefix' => '{locale?}/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.customize.integrations.mails.purchase' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/dashboard/customize/integrations/mails/purchase',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'has.subscription',
          3 => 'store-owner',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Customize\\Mails\\PurchaseMailController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Customize\\Mails\\PurchaseMailController',
        'as' => 'dashboard.customize.integrations.mails.purchase',
        'namespace' => NULL,
        'prefix' => '{locale?}/dashboard/customize/integrations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.payouts' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/dashboard/payouts',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'has.subscription',
          3 => 'store-owner',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Payouts\\PayoutsController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Payouts\\PayoutsController',
        'as' => 'dashboard.payouts',
        'namespace' => NULL,
        'prefix' => '{locale?}/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.payouts.send' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '{locale?}/dashboard/payouts/{commission}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'has.subscription',
          3 => 'store-owner',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Payouts\\SendPayoutController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Payouts\\SendPayoutController',
        'as' => 'dashboard.payouts.send',
        'namespace' => NULL,
        'prefix' => '{locale?}/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.account' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/dashboard/account',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'has.subscription',
          3 => 'store-owner',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Account\\AccountController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Account\\AccountController',
        'as' => 'dashboard.account',
        'namespace' => NULL,
        'prefix' => '{locale?}/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.account.save' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '{locale?}/dashboard/account',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'has.subscription',
          3 => 'store-owner',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Account\\UpdateAccountController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Account\\UpdateAccountController',
        'as' => 'dashboard.account.save',
        'namespace' => NULL,
        'prefix' => '{locale?}/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.settings' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/dashboard/settings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'has.subscription',
          3 => 'store-owner',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Settings\\SettingsController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Settings\\SettingsController',
        'as' => 'dashboard.settings',
        'namespace' => NULL,
        'prefix' => '{locale?}/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.settings.save' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '{locale?}/dashboard/settings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'has.subscription',
          3 => 'store-owner',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Settings\\UpdateSettingsController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Settings\\UpdateSettingsController',
        'as' => 'dashboard.settings.save',
        'namespace' => NULL,
        'prefix' => '{locale?}/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.help' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/dashboard/help',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'has.subscription',
          3 => 'store-owner',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\HelpController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\HelpController',
        'as' => 'dashboard.help',
        'namespace' => NULL,
        'prefix' => '{locale?}/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.activity' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/dashboard/activity',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'has.subscription',
          3 => 'store-owner',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Activity\\ActivityController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Activity\\ActivityController',
        'as' => 'dashboard.activity',
        'namespace' => NULL,
        'prefix' => '{locale?}/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.activity.read.all' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/dashboard/activity/read',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'has.subscription',
          3 => 'store-owner',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Activity\\ActivityMarkAllAsReadController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Activity\\ActivityMarkAllAsReadController',
        'as' => 'dashboard.activity.read.all',
        'namespace' => NULL,
        'prefix' => '{locale?}/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.activity.read' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/dashboard/activity/{notification}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'has.subscription',
          3 => 'store-owner',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Activity\\ActivityMarkAsReadController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Activity\\ActivityMarkAsReadController',
        'as' => 'dashboard.activity.read',
        'namespace' => NULL,
        'prefix' => '{locale?}/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.preview.checkout' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/dashboard/preview/checkout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'has.subscription',
          3 => 'store-owner',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Preview\\CheckoutPreviewController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Preview\\CheckoutPreviewController',
        'as' => 'dashboard.preview.checkout',
        'namespace' => NULL,
        'prefix' => '{locale?}/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.plan' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/dashboard/plan',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'has.subscription',
          3 => 'store-owner',
        ),
        'uses' => 'O:47:"Laravel\\SerializableClosure\\SerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Signed":2:{s:12:"serializable";s:320:"O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:101:"function() {
            return \\redirect()->route(\'dashboard.account\', [\'tab\' => \'plan\']);
        }";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000006d4d494f00000000080bfdf6";}";s:4:"hash";s:44:"fsLxgPJFXQJPp3YuShlZz6sbxZGfHWaGoY0sPkxR144=";}}',
        'as' => 'dashboard.plan',
        'namespace' => NULL,
        'prefix' => '{locale?}/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.plan.upgrade' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/dashboard/plan/upgrade',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'has.subscription',
          3 => 'store-owner',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Plan\\UpgradePlanController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Plan\\UpgradePlanController',
        'as' => 'dashboard.plan.upgrade',
        'namespace' => NULL,
        'prefix' => '{locale?}/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.plan.cancel' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/dashboard/plan/cancel',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'has.subscription',
          3 => 'store-owner',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Account\\CancelSubscriptionController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Dashboard\\Account\\CancelSubscriptionController',
        'as' => 'dashboard.plan.cancel',
        'namespace' => NULL,
        'prefix' => '{locale?}/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/admin',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'admin',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Admin\\Stats\\IndexController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Admin\\Stats\\IndexController',
        'as' => 'admin',
        'namespace' => NULL,
        'prefix' => '{locale?}/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.stores' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/admin/stores',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'admin',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Admin\\Stores\\IndexController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Admin\\Stores\\IndexController',
        'as' => 'admin.stores',
        'namespace' => NULL,
        'prefix' => '{locale?}/admin/stores',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.stores.enable' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '{locale?}/admin/stores/{store}/enable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'admin',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Admin\\Stores\\EnableStoreController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Admin\\Stores\\EnableStoreController',
        'as' => 'admin.stores.enable',
        'namespace' => NULL,
        'prefix' => '{locale?}/admin/stores',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.stores.disable' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '{locale?}/admin/stores/{store}/disable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'admin',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Admin\\Stores\\DisableStoreController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Admin\\Stores\\DisableStoreController',
        'as' => 'admin.stores.disable',
        'namespace' => NULL,
        'prefix' => '{locale?}/admin/stores',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.stores.view' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/admin/stores/{store}/view',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'admin',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\ViewStoreController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\ViewStoreController',
        'as' => 'admin.stores.view',
        'namespace' => NULL,
        'prefix' => '{locale?}/admin/stores',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/admin/accounts',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'admin',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Admin\\Users\\IndexController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Admin\\Users\\IndexController',
        'as' => 'admin.users',
        'namespace' => NULL,
        'prefix' => '{locale?}/admin/accounts',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users.ban' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '{locale?}/admin/accounts/{user}/ban',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'admin',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Admin\\Users\\BanController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Admin\\Users\\BanController',
        'as' => 'admin.users.ban',
        'namespace' => NULL,
        'prefix' => '{locale?}/admin/accounts',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users.password.reset' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '{locale?}/admin/accounts/{user}/password/reset',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'admin',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Admin\\Users\\ResetPasswordController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Admin\\Users\\ResetPasswordController',
        'as' => 'admin.users.password.reset',
        'namespace' => NULL,
        'prefix' => '{locale?}/admin/accounts',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.settings' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/admin/settings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'admin',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Admin\\Settings\\IndexController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Admin\\Settings\\IndexController',
        'as' => 'admin.settings',
        'namespace' => NULL,
        'prefix' => '{locale?}/admin/settings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.settings.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '{locale?}/admin/settings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'admin',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Admin\\Settings\\UpdateSettingsController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Admin\\Settings\\UpdateSettingsController',
        'as' => 'admin.settings.update',
        'namespace' => NULL,
        'prefix' => '{locale?}/admin/settings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.logs' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/admin/logs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'admin',
        ),
        'uses' => '\\Rap2hpoutre\\LaravelLogViewer\\LogViewerController@index',
        'controller' => '\\Rap2hpoutre\\LaravelLogViewer\\LogViewerController@index',
        'as' => 'admin.logs',
        'namespace' => NULL,
        'prefix' => '{locale?}/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webhooks.customer.show' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '{locale?}/webhooks/customers/data_request',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
          2 => 'is-shopify-webhook',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Webhooks\\ShowCustomerController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Webhooks\\ShowCustomerController',
        'as' => 'webhooks.customer.show',
        'namespace' => NULL,
        'prefix' => '{locale?}/webhooks',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webhooks.customer.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '{locale?}/webhooks/customers/redact',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
          2 => 'is-shopify-webhook',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Webhooks\\DeleteCustomerController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Webhooks\\DeleteCustomerController',
        'as' => 'webhooks.customer.delete',
        'namespace' => NULL,
        'prefix' => '{locale?}/webhooks',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webhooks.store.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '{locale?}/webhooks/shop/redact',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
          2 => 'is-shopify-webhook',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Webhooks\\DeleteStoreController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Http\\Controllers\\Webhooks\\DeleteStoreController',
        'as' => 'webhooks.store.delete',
        'namespace' => NULL,
        'prefix' => '{locale?}/webhooks',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'blog.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{locale?}/blog',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'BADDIServices\\SocialRocket\\Blog\\Controllers\\IndexController@__invoke',
        'controller' => 'BADDIServices\\SocialRocket\\Blog\\Controllers\\IndexController',
        'as' => 'blog.index',
        'namespace' => NULL,
        'prefix' => '{locale?}/blog',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
