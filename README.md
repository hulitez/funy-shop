**First run**

    `cd docker`

    `docker-compose up`

**Credentials**

    `login: admin`
    `password: weakPassword321*`

**For proper operation, changes are necessary in:**

    `src/.env`

*please provide proper addresses*

    `MAILER_DSN=smtp://user:pass@smtp.example.com:port #dns of mail server

     SLACK_DSN=slack://default/ID  #slack on witch notification will be sended

     ADMIN_EMAIL=login@example.com` #email on witch notification will be sended
