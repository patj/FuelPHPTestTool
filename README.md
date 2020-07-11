# FuelPHPTestTool

FuelPHPプロジェクト開発時に使える自動実行テストツール

監視モードで起動すると、最終保存したテストファイルがPHPUnit/Codeceptionのどちらだったかを自動判定して、プログラムファイルやテストファイルを更新する度に、PHPUnit/Codeceptionを自動で実行します。


# 初期設定

## Codeception, PHPUnit の設定

省略

codeceptionを プロジェクトディレクトリ/codeception/ にinitした場合を想定しています。別のディレクトリに設置した場合は `->monitor( './codeception/tests/acceptance/' ) `の部分を変更してください。


## RoboFile.phpの配置

プロジェクトディレクトリに RobFile.php を配置する。

## パッケージの追加

composer.json に以下のパッケージを追加する

```
(略)
	"consolidation/robo": "*",
	"symfony/config": "^3.0",
	"symfony/event-dispatcher" : "^3.0",
	"henrikbjorn/lurker": "*"
(略)
```

```
$ php composer.phar update
```


# 使い方

## 監視モード

```
$ cd プロジェクトディレクトリ
$ ./fuel/vendor/bin/robo watch
```

## PHPUnit

```
$ cd プロジェクトディレクトリ
$ ./fuel/vendor/bin/robo phpunit
```

## codeception

```
$ cd プロジェクトディレクトリ
$ ./fuel/vendor/bin/robo codeception
```


# 動作確認環境

- OS : macOS Catalina ( 10.15.4 )
- PHP : PHP 7.2.29 (cli) (built: Mar 25 2020 16:05:31) ( NTS ) ※ PHPBrewでインストール
- FuelPHP : 1.8.2

