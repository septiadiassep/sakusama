# Sakusama Team
Project pencatatan keuangan keluarga 

![GitHub forks](https://img.shields.io/github/forks/septiadiassep/sakusama.svg) ![GitHub contributors](https://img.shields.io/github/contributors/septiadiassep/sakusama.svg) ![GitHub top language](https://img.shields.io/github/languages/top/septiadiassep/sakusama.svg)

## Installasi Project Sakusama v1.0

```.sh
git clone https://github.com/septiadiassep/sakusama.git
```

```.sh
cd sakusama
code .
```

```.sh
composer install
cp .env.example .env
php artisan key:generate
```

```.env
APP_NAME=sakusama
APP_KEY=key-generated-automated

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_sakusama
DB_USERNAME=root
DB_PASSWORD=!!&21adi
```

```.sh
npm install
php artisan migrate

Akses => INFO  Server running on [http://127.0.0.1:8000]. 
```

Tambahkan 1 file `.gitignore`

```.gitignore
/.phpunit.cache
/node_modules
/public/build
/public/hot
/public/storage
/storage/*.key
/storage/pail
/vendor
.env
.env.backup
.env.production
.phpactor.json
.phpunit.result.cache
Homestead.json
Homestead.yaml
npm-debug.log
yarn-error.log
/auth.json
/.fleet
/.idea
/.nova
/.vscode
/.zed
```
