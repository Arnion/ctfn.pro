# Tech steps
> You need a vps server to deploy ctfn.

1. Download the `/contracts/` folder from the repository.
2. Deploy `/contracts/CtfnAdmin.sol` from the repository to the test and main BNB networks
3. Upload the files of the `/src/` directory to the vps server
4. Configure the domain to open `/frontend/web/index.php`
5. Configure the admin subdomain to open `/backend/web/index.php`

## Configuring the database

6. Import all .sql files from `/src/database/` into your database.
7. To create the first administrator entry for a subdomain, run the following query in the database.

```bash
INSERT INTO `admins` (`email`, `password_hash`, `name`, `role`, `active`, `login`, `auth_key`) VALUES ('admin@example.com', '$2y$13$U5CaEB7lVkjNRVahaKA0MO69Ryy1oszINryZChIspGp.85fZ0E1Lu', 'admin', 1, 1, 'YWRtaW5AZXhhbXBsZS5jb20', 's66y2yAJfs0el_KdIqE35pNIk1Gt3MYR')
```
After the configuration is complete, you can log in to admin.example.com/login using admin@example.com and the password admin123

## Configuring the /frontend/config/main.php configuration file

8. In the `homeUrl` key specify a direct link to the domain: https://example.com
9. In the `db` key specify the settings for connecting to the database
10. In the key `reCaptcha` specify api keys from Google Captcha v3 

## Configuring the configuration file /frontend/config/main-local.php

11. In the `cookieValidationKey` specify a random string `md5()`.

## Configuring the /backend/config/main.php configuration file

12. In the `homeUrl` key specify a direct link to the subdomain: https://admin.example.com
13. In the `db` key specify settings to connect to the database

## Configuring the /backend/config/params.php configuration file

14. Specify the administrator's email address in adminEmail

## Configuring the configuration file /backend/config/main-local.php

15. In the `cookieValidationKey` specify a random string `md5()`.

## Configuring the configuration file /common/config/params.php

16. Specify the administrator's email address in the `adminEmail` key
17. In the `adminName` key, enter the name of the administrator
18. Specify the sender's email address in the `senderEmail` key
19. In the `senderName` key, enter the sender name of the email
20. In the key `site` specify the site: example.com
21. In the `homeUrl` key, specify a direct link to the domain (as in the frontend main.php)
22. In the `adminUrl` key, specify a direct link to the subdomain (as in the backend main.php)
23. in the `cert_salt` key specify a random string of at least 6 characters in length
24. Optional.  You can specify settings for postman by specifying the following keys.

'postman_ip' => '', 'postman_passwd' => '', 'postman_login' => '', 'postman_domain' => '',

## Setup file /frontend/web/js/adminctfnpromainnet.js
25. Specify the `CONTRACT_ADDRESS` of the contract on the main network

## Setting up the /frontend/web/js/adminctfnprotestnet.js file
26. Specify the `CONTRACT_ADDRESS` of the contract on the test network
