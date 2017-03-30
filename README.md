px2-include-php-code
=========

Pickles 2 に、パブリッシュ後のコードにPHPを出力できる文法を追加します。

## 使い方 - Usage

埋め込みPHPコードを `<!--?php` と `?-->` で囲います。

```
<!--?php echo "PHP Code" ?-->
```

埋め込まれたPHPコードは、 プレビュー時には `eval()` コードとして実行され、 パブリッシュ時に `<?php 〜〜〜 ?>` に変換されて出力されます。


## セットアップ - Setup

### 1. [Pickles 2](http://pickles2.pxt.jp/) をセットアップ

### 2. composer.json に、パッケージ情報を追加

```
{
    "repositories": [
        {
            "type": "git",
            "url": "https://github.com/tomk79/px2-include-php-code.git"
        }
    ],
    "require": {
        "tomk79/px2-include-php-code": "dev-master"
    }
}
```

### 3. composer update

更新したパッケージ情報を反映します。

```
$ composer update
```

### 4. config.php を更新

`$conf->funcs->html` に、プラグインを設定します。

```
<?php
return call_user_func( function(){

  /* (中略) */

  $conf->funcs->processor->html = array(
		// px2-include-php-code
		// Pickles 2 に、パブリッシュ後のコードにPHPを出力できる文法を追加します。
		'tomk79\pickles2\px2_include_php_code\main::exec()' ,

  );

  /* (中略) */

  return $conf;
} );
```


## ライセンス - License

Copyright (c)2001-2016 Tomoya Koyanagi, and Pickles 2 Project<br />
MIT License https://opensource.org/licenses/mit-license.php


## 作者 - Author

- Tomoya Koyanagi <tomk79@gmail.com>
- website: <http://www.pxt.jp/>
- Twitter: @tomk79 <http://twitter.com/tomk79/>
