# docker-base
Based on the great [Webdevops Dockerfile](https://github.com/webdevops/Dockerfile).  
Move the most Configuration to .env File. 

Run with make commands. Simply run `make list` to see the commands.

# Predis Install
Run  `make build`
Run  `make start`
Run  `make bash`

Inside bash  `cd /app/public`
             `composer require predis/predis`  

Exit bash and call http://localhost
Example of redis usage find in /app/public/index.php