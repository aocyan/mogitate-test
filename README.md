mogitate(もぎたて)
〇環境構築手順(osはwindowsを使用しておりますので、osをmac使用の際は適宜環境構築お願いします。)
1.ubuntu内でgit clone git@github.com:aocyan/mogitate-test.git を実行しクローンする。
2.DockerDesktopアプリを立ち上げる
3.ubuntu内でdocker-compose up -d --buildを実行する。(mogitate-testディレクトリ内で実行する）
4.ubuntu上で code . を実行し、
　".yml"ファイル内の
    mysql:
        image: mysql:8.0.26
        environment:
            MYSQL_ROOT_PASSWORD: root
            MYSQL_DATABASE: laravel_db
            MYSQL_USER: laravel_user
            MYSQL_PASSWORD: laravel_pass
　であることを確認してください。
5.ubntu上で docker-compose exec php bash を実行し、PHPコンテナ上で
　composer install　を実行する。
6."5"に続いてPHPコンテナ上で
　cp .env.example .env を実行し、.envファイルをコピーする
7."6"でコピーした".env"ファイルと".yml"ファイルを同期する
　.envファイルを
     DB_HOST=mysql
     DB_DATABASE=laravel_db
     DB_USERNAME=laravel_user
     DB_PASSWORD=laravel_pass
 に設定を変更する。
 ※'.env' を保存できませんでした。とエラーが出た場合は、ubuntu内mogitate-testディレクトリ内で
   sudo chown ユーザ名:ユーザ名 ファイル名　でファイルを書き換える権限を付与させてください。
   例：sudo chown aocyan:aocyan /home/aocyan/coachtech/laravel/mogitate-test/src/.env
8. http://localhost:8080 にデータベースが存在しているか確認する（laravel_dbがあるか確認してください）
9.ubuntu内PHPコンテナ上で
　php artisan key:generate　を実行し、アプリケーションキーを生成する。
10.ubuntu内PHPコンテナ上で
  php artisan migrate　を実行し、マイグレーションする。
11.ubuntu内PHPコンテナ上で
　php artisan db:seed　を実行し、シーダファイルを挿入する。
12.http://localhost/productsにアクセスする
　※permissionエラーが出た際には、ubuntu内mogitate-testディレクトリで、
 　　sudo chmod -R 777 src/*　を実行してください。

使用技術(実行環境)
PHP8.3.0
Laravel8.83.27
MySQL8.0.26
ubuntu
ER図


URL
開発環境：http://localhost/
phpMyAdmin:：http://localhost:8080/
