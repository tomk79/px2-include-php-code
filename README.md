px2-include-php-code
=========

Pickles 2 に、パブリッシュ後のコードにPHPを出力できる文法を追加します。

## 使い方 - Usage

埋め込みPHPコードを `<!--?php` と `?-->` で囲います。

```php
<!--?php include($_SERVER['DOCUMENT_ROOT'])."/common/includes/sample.inc" ?-->
```

埋め込まれたPHPコードは、 プレビュー時には `eval()` コードとして実行され、 パブリッシュ時に `<?php 〜〜〜 ?>` に変換されて出力されます。

### 課題

- 名前空間の管理が直感に反します。
- ファイル自身のパスが直感に反します。
- 実行される時勢が直感に反します。

プレビュー時、 `<!--?php` と `?-->` の間の文字列を `eval()` コードとして後で実行されるために起きる問題です。 パブリッシュされたファイルでは `<?php 〜〜〜 ?>` に変換されるので即座に実行されるので、プレビュー時と実行結果に違いが現れる場合があります。

## セットアップ - Setup

### 1. [Pickles 2](https://pickles2.pxt.jp/) をセットアップ

```
$ composer create-project pickles2/preset-get-start-pickles2 ./
```

### 2. composer.json に、パッケージ情報を追加

```json
{
    "require": {
        "tomk79/px2-include-php-code": "^0.1"
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

```php
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


## 更新履歴 - Changelog

### tomk79/px2-include-php-code v0.1.1 (2019年1月15日)

- 複数のPHPブロックに分割されたコードが、プレビュー時に文法エラーを起こす問題を修正。

### tomk79/px2-include-php-code v0.1.0 (2019年1月12日)

- Initial Release.


## ライセンス - License

Copyright (c)2001-2019 Tomoya Koyanagi, and Pickles 2 Project<br />
MIT License https://opensource.org/licenses/mit-license.php


## 作者 - Author

- Tomoya Koyanagi <tomk79@gmail.com>
- website: <https://www.pxt.jp/>
- Twitter: @tomk79 <https://twitter.com/tomk79/>
