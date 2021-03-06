# Fullcarender + Google Calender

jQueryライブラリ「Fullcarender」とGoogleカレンダーを連携させたサンプルです。 

デモはこちら https://leo-loki.github.io/base/gcal/

## ◆設定方法

### １）Googleアカウントの取得

ここで使用するGoogleカレンダー用に新しいGoogleアカウントを取得します。

他のサイトやプライベートで使用しているGoogleアカウントは使用しないようにしましょう。

### ２）Google APIキーの取得

「Google API Console - Google Cloud Console」
 https://console.cloud.google.com/
で、カレンダー用のAPIキーを取得しておきます。

### ３）Googleカレンダーの作成・設定

連携させるGoogleカレンダーを作成し、設定から一般公開にしておきます。

※一般公開されていないカレンダーは連携させることができません。

### ４）GoogleカレンダーIDを取得

連携させるGoogleカレンダーの設定からカレンダーのIDを取得しておきます。

### ５）スクリプトにAPIキーとカレンダーIDを設定

「js」ディレクトリ内の「script.js」ファイルへ先に取得したAPIキーとカレンダーIDを設定します。

このサンプルでは複数のGoogleカレンダーと連携するようになっていますが、
連携させるGoogleカレンダーが一つだけで良い場合は、「script.js」ファイルの
ソースコード21行目〜39行目までを削除して使用します。

### ６）CSSでデザインをカスタマイズ

「css」ディレクトリ内の「style.scss」または「style.css」ファイルでデザインをカスタマイズします。

Google Chrome 等のブラウザの開発ツール（検証）を利用してタグ・ID・クラス名などを調べてプロパティを上書きしていくと便利です。

## ◆その他の事項

このサンプルはご自由にお使いください。

ただし、jQueryライブラリ「Fullcarender」とGoogleカレンダーのライセンスにつきましては、それぞれの制作者に帰属します。

「Fullcarender」をイチから試してみたい方は、公式サイト（ https://fullcalendar.io/ ）のからダウンロードしてどうぞ。

「Fullcarender」のカスタマイズ方法、Google APIキーの取得・Googleカレンダーの作成・設定やカレンダーIDの取得などについては、いろいろググってみてください。

※このサンプルに関するお問い合わせ・ご質問などにはお答えできません。

また、このサンプルを利用することにより発生した不具合や不利益などに対しても、当方では一切、責任を追いませんので予めご了承ください。

添付の「MIT License」ファイルもご一読ください。
