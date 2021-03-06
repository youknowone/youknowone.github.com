<!doctype html>
<? require "data.php" ?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <title><?=$user['name']?> - <?=$user['username']?>.github.com</title>

    <link rel="stylesheet" href="stylesheets/styles.css">
    <link rel="stylesheet" href="stylesheets/pygment_trac.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="wrapper">
      <header>
        <h1><a href="#top"><?=$user['name']?></a></h1>
        <p><?=$user['title']?></p>
        <p class="view"><a href="https://github.com/youknowone/">View all Projects on GitHub <small>github.com/youknowone</small></a></p>
        <? $minors = array(); ?>
        <? foreach ($projects as $name => $project):
          if (isset($project['minor']) && $project['minor']) {
            $minors[$name] = $project;
            continue;
          }
          extract($project); ?>
        <h3><a href="#<?=$name?>"><?=$name?></a></h3>
        <p class="view"><?=$description?><a href="https://github.com/<?=$github?>"><small><?=$github?></small></a></p>
        <? endforeach ?>
        <? if (count($minors)): ?>
        <h3>Others</h3>
        <p>
        <? foreach ($minors as $name => $project): ?>
        [<a href="#<?=$name?>"><?=$name?></a>] 
        <? endforeach ?>
        </p>
        <? endif ?>
      </header>

      <section id="top">
        <?=$user['description']?>

        <? foreach ($projects as $name => $project): extract($project); ?>
        <section>
        <aside>
        <? if (isset($project['links'])): ?>
        <? foreach ($links as $link): ?>
        <p class="view"><a href="http://<?=$link['link']?>">View the <?=$link['title']?> <small><?=$link['link']?></small></a></p>
        <? endforeach ?>
        <? endif ?>
        <p class="view"><a href="https://github.com/<?=$github?>">View the Project on GitHub <small><?=$github?></small></a></p>
        </aside>
        <h3 id="<?=$name?>"><?=$name?></h3>
        <? if ($project['description']): ?><p><?=$description?></p><? endif ?>
        <? if ($project['longdescription']): ?><p><?=$longdescription?></p><? endif ?>
       
        <? if (isset($project['downloads'])): ?>
        <ul>
          <? foreach ($downloads as $download): ?>
          <li><a href="<?=$download['link']?>"><? if (isset($download['download'])): ?><?=$download['download']?><? else: ?>Download<? endif ?> <strong><?=$download['title']?></strong></a></li>
          <? endforeach ?>
          <? if (count($downloads) < 3): ?>
          <li><a href="https://github.com/<?=$github?>">View On <strong>GitHub</strong></a></li>
          <? endif ?>
        </ul>
        <? endif ?>

        <? if ($project['install']): ?>
        <? foreach ($install as $media => $installitem): ?>
        <h4>
          <?
            if (isset($installers[$media])) {
              $installer = $installers[$media];
            } else {
              $installer = $installitem;
              $installer['from'] = $media;
            }
          ?>
          <? if (isset($installer['title'])): ?>
            <?=$installer['title']?>
          <? else: ?>
            Install from <? if (isset($installer['link'])): ?><a href="<?=$installer['link']?>"><? endif ?><?=$installer['from']?><? if (isset($installer['link'])): ?></a><? endif ?>
          <? endif ?>
        </h4>
        <? if (isset($installitem['description'])): ?>
          <p><?=$installitem['description']?></p>
        <? endif ?>
        <pre><code><?=sprintf($installer['instruction'], isset($installitem['name']) ? $installitem['name'] : $name )?></pre></code>
        <? endforeach ?>
        <? endif ?>

        <h4>Download source code</h4>
        <p><a href="https://github.com/<?=$github?>/zipball/master">Zip ball</a>, <a href="https://github.com/<?=$github?>/tarball/master">Tar ball</a> or git-clone:</p>
<pre><code>$ git clone git://github.com/<?=$github?>.git
$ cd <? $githubelems = split('/', $github); echo $githubelems[1]."\n"; ?>
<? if (isset($project['submodule']) && $project['submodule']): ?>
$ git submodule update --init
<? endif ?><? if (isset($project['cocoapod']) && $project['cocoapod']): ?>
$ pod install
<? endif ?><? if (isset($project['open'])): ?>
<? printf($openers[$project['open']['type']], $project['open']['file']); ?>
<? endif ?></code></pre>
        </section>
        <? endforeach ?>

        <?=$user['postscript']?>
      </section>
      <footer>
        <p>These projects are maintained by <a href="https://github.com/youknowone">youknowone</a></p>
        <p><small>Generated by <a href="https://github.com/youknowone/github-profile">github-profile</a></small></p>
        <p><small>Hosted on GitHub Pages &mdash; Theme by <a href="https://github.com/orderedlist">orderedlist</a></small></p>
      </footer>
    </div>
    <script src="javascripts/scale.fix.js"></script>
    
  </body>
</html>