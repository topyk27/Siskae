# SISKAE
Sistem Informasi Surat Keputusan Tugas Elektronik (SISKAE) adalah sebuah aplikasi yang mengirimkan notifikasi berupa Surat Keputusan / Surat Tugas kepada pihak yang namanya tercantum dalam surat tersebut melalui media pesan WhatsApp.

## Instalasi
1. Pindahkan folder ini ke komputer server.
2. Buat database dengan nama `skst` di server.
3. Silahkan import file sql yang ada di folder ini.
4. Buka file `application/config/database.php`.
5. Sesuaikan username, password, dan databasenya.
```
$db['default'] = array(
	...
	'username' => 'usernameAnda',
	'password' => 'passwordAnda',
	'database' => 'skst',
	...
);
```
6. Buka browser dan masukkan `IP SERVER/Siskae`.
7. Data login
```
silahkan hubungi administrator untuk data loginnya
```
8. Saya sarankan menggunakan browser Google Chrome yang terbaru, install ekstensi [Tampermonkey](https://chrome.google.com/webstore/detail/tampermonkey/dhdgffkkebhmkfjojejmpbldmpobfkfo) dan [Force Background Tab](https://chrome.google.com/webstore/detail/force-background-tab/gidlfommnbibbmegmgajdbikelkdcmcl)
9. Install Script [SISKAE](https://gist.github.com/topyk27/284b8fc9a1fcbd7bab24cfb15cc40a17/raw/siskae-tgr.user.js)
![alt text](https://github.com/topyk27/siskae/blob/main/asset/img/img-1.png?raw=true)

## Penggunaan
Cara penggunaan bisa dilihat pada menu home setelah berhasil login.

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)