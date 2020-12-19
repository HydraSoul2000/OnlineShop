# OnlineShop
  Apache version: Apache/2.4.43 (Win64) OpenSSL/1.1.1g PHP/7.4.7;
  Php framework: Symfony 5

Simple OnlineShop prototype i created with Symfony 5 php framework.

In this project there is login system where you must create a table row (user) on your own and in password field you must add encrypted password, by doing that with bin/console security:encode-password 'yourpasswordhere'.
When you are logged in, you can create new posts for onlineshop, and you can remove existing posts from the shop. 
You can view each post individualy, doesnt matter if you are logger, or not.
Create tab shows up only when you are logged in, so people who arent users can't make posts.
